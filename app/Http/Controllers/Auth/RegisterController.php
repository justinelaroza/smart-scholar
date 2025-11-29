<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\IprogSmsService;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Services\OtpService;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function store(Request $request, IprogSmsService $sms, OtpService $otpService)
    {   
        // Normalize phone before validation
        $request->merge([
            'phone' => $otpService->normalizePhoneNumber($request->input('phone'))
        ]);

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'gender'     => 'required|in:Male,Female',
            'birthday'   => 'required|date',
            'address'    => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'phone'      => [
            'required', 'string', 'max:15', 'unique:users,phone_number',
                function ($attr, $value, $fail) use ($otpService) {
                    if (!$otpService->isValidPhilippineNumber($value)) {
                        $fail('Invalid Philippine phone number.');
                    }
                }
            ],
            'password'   => 'required|string|min:6|confirmed',
        ]);

        $phone = $validated['phone'];
        $otp = $otpService->createOtp($phone);
        $resp = $otpService->sendOtpSms($sms, $phone, $otp->code);

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
        $user = User::create([
            'first_name'   => $reg['first_name'],
            'last_name'    => $reg['last_name'],
            'gender'       => $reg['gender'],
            'birthday'     => $reg['birthday'],
            'full_address' => $reg['address'],
            'email'        => $reg['email'],
            'phone_number' => $reg['phone'],
            'password'     => Hash::make($reg['password']),
            'account_code' => 'TEMP',
        ]);

        $prefix = str_pad($user->id, 2, '0', STR_PAD_LEFT);
        $accountCode = "{$prefix}-" . strtoupper($reg['last_name']);

        $user->update(['account_code' => $accountCode]);
        
        return $user;
    }

    private function jsonOrBack(Request $request, string $message, int $status = 422)
    {
        return $request->expectsJson()
            ? response()->json(['status' => 'error', 'message' => $message], $status)
            : back()->withErrors(['register_error' => $message]);
    }
}
