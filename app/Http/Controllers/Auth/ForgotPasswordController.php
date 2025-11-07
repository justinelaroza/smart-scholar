<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\IprogSmsService;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ForgotPasswordController extends Controller
{ 
    public function show() 
    {
        return view('auth.forgot-password');
    }

    private function normalizePhoneNumber(string $phone): string
    {
        $digits = preg_replace('/\D/', '', $phone);

        if (str_starts_with($digits, '0')) {
            $digits = '63' . substr($digits, 1);
        }

        if (!str_starts_with($digits, '63')) {
            $digits = '63' . $digits;
        }

        return $digits;
    }

    private function createOtp(string $phone): Otp
    {
        return Otp::create([
            'phone_number' => $phone,
            'code'         => (string) random_int(100000, 999999),
            'expires_at'   => now()->addMinutes(5),
            'used'         => false,
        ]);
    }

    private function sendOtpSms(IprogSmsService $sms, string $phone, string $code): array
    {
        $message = "Your OTP code is {$code}. It will expire in 5 minutes.";
        $resp = $sms->sendSms($phone, $message);

        return $resp;
    }

    public function update(Request $request, IprogSmsService $sms)
    {
        $request->merge([
            'phone' => $this->normalizePhoneNumber($request->input('phone'))
        ]);

        $validated = $request->validate([
            'phone'    => 'required|string|max:15|exists:users,phone_number',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $phone = $validated['phone'];
        $otp = $this->createOtp($phone);
        $resp = $this->sendOtpSms($sms, $phone, $otp->code);

        if (!$resp['ok']) {
            $otp->delete();

            return $request->expectsJson()
                ? response()->json(['status' => 'error', 'message' => 'Failed to send OTP. Please try again.'], 200)
                : back()->withErrors(['forgot_error' => 'Failed to send OTP. Please try again.'])->onlyInput('phone');
        }

        $request->session()->put('reset_data', [
            'phone'    => $phone,
            'password' => $validated['password']
        ]);

        return $request->expectsJson()
            ? response()->json(['status' => 'ok', 'pending_id' => $otp->id])
            : redirect()->route('forgot.verify')->with('otp_sent', true);
    }

    public function verifyOtp(Request $request)
    {
      $validated = $request->validate([
          'otp_code'   => 'required|string|size:6',
          'pending_id' => 'nullable|integer',
      ]);

      $resetData = $request->session()->get('reset_data');
      if (!$resetData) {
          return $this->jsonOrBack($request, 'Session expired. Please try again.', 422);
      }

      $phone = $resetData['phone'];
      $newPassword = $resetData['password'];

      $otp = Otp::where('phone_number', $phone)->where('code', $validated['otp_code'])->where('used', false)->latest()->first();

      if (!$otp || $otp->isExpired()) {
          return $this->jsonOrBack($request, 'Invalid or expired OTP.', 422);
      }

      $otp->update(['used' => true]);

      $user = User::where('phone_number', $phone)->first();
      if ($user) {
          $user->update(['password' => Hash::make($newPassword)]);
      }

      // Clear session
      $request->session()->forget('reset_data');

      return $request->expectsJson()
          ? response()->json(['status' => 'ok', 'message' => 'Password reset successful!'])
          : redirect()->route('login')->with('success', 'Password reset successful! You can now log in.');
    }

    private function jsonOrBack(Request $request, string $message, int $status = 422)
    {
        return $request->expectsJson()
            ? response()->json(['status' => 'error', 'message' => $message], $status)
            : back()->withErrors(['forgot_error' => $message]);
    }
}
