<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\IprogSmsService;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
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

        if (app()->environment('local') && !$resp['ok']) {
            Log::warning('IPROG SMS failed in local; allowing flow.', ['resp' => $resp]);
            $resp['ok'] = true;
        }

        return $resp;
    }

    public function store(Request $request, IprogSmsService $sms)
    {   
        // Normalize phone before validation
        $request->merge([
            'phone' => $this->normalizePhoneNumber($request->input('phone'))
        ]);

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'gender'     => 'required|in:Male,Female',
            'birthday'   => 'required|date',
            'address'    => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'phone'      => 'required|string|max:15|unique:users,phone_number',
            'password'   => 'required|string|min:6|confirmed',
        ]);

        $phone = $validated['phone'];
        $otp = $this->createOtp($phone);
        $resp = $this->sendOtpSms($sms, $phone, $otp->code);

        // If SMS failed
        if (!$resp['ok']) {
            $otp->delete();

            return $request->expectsJson()
                ? response()->json(['status' => 'error', 'message' => 'Failed to send OTP. Please try again.'], 200)
                : back()->withErrors(['register_error' => 'Failed to send OTP. Please try again.'])->onlyInput('phone');
        }

        // Store registration info in session
        $request->session()->put('registration_data', [
            'first_name' => $validated['first_name'],
            'last_name'  => $validated['last_name'],
            'gender'     => $validated['gender'],
            'birthday'   => $validated['birthday'],
            'address'    => $validated['address'],
            'phone'      => $phone,
            'email'      => $validated['email'],
            'password'   => $validated['password'],
        ]);

        // Response
        return $request->expectsJson()
            ? response()->json(['status' => 'ok', 'pending_id' => $otp->id])
            : redirect()->route('register.verify')->with('otp_sent', true);
    }

    public function verifyOtp(Request $request)
    {
        $validated = $request->validate([
            'otp_code'   => 'required|string|size:6',
            'pending_id' => 'nullable|integer',
        ]);

        $reg = $request->session()->get('registration_data');
        if (!$reg) {
            return $this->jsonOrBack($request, 'Registration session expired. Please register again.', 422);
        }

        $otp = Otp::where('phone_number', $reg['phone'])->where('code', $validated['otp_code'])->where('used', false)->latest()->first();

        if (!$otp || $otp->isExpired()) {
            return $this->jsonOrBack($request, 'Invalid or expired OTP.', 422);
        }

        $otp->update(['used' => true]);

        $user = $this->createUserFromRegistration($reg);
        $request->session()->forget('registration_data');

        return $request->expectsJson()
            ? response()->json(['status' => 'ok', 'account_code' => $user->account_code])
            : redirect()->route('login')->with('success', 'Registration complete! You can now log in.');
    }

    private function createUserFromRegistration(array $reg): User
    {
        $userNumber = User::count() + 1;
        $prefix = str_pad($userNumber, 2, '0', STR_PAD_LEFT);
        $accountCode = "{$prefix}-" . strtoupper($reg['last_name']);

        return User::create([
            'first_name'   => $reg['first_name'],
            'last_name'    => $reg['last_name'],
            'gender'       => $reg['gender'],
            'birthday'     => $reg['birthday'],
            'full_address' => $reg['address'],
            'email'        => $reg['email'],
            'phone_number' => $reg['phone'],
            'password'     => Hash::make($reg['password']),
            'account_code' => $accountCode,
        ]);
    }

    private function jsonOrBack(Request $request, string $message, int $status = 422)
    {
        return $request->expectsJson()
            ? response()->json(['status' => 'error', 'message' => $message], $status)
            : back()->withErrors(['register_error' => $message]);
    }
}
