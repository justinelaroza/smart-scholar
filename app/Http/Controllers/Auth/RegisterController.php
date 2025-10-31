<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\IprogSmsService;
use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    /**
     * Step 1: Validate, store session, send OTP, return JSON (200).
     */
    public function store(Request $request, IprogSmsService $sms)
    {
        $validated = $request->validate([
            'first_name'            => 'required|string|max:255',
            'last_name'             => 'required|string|max:255',
            'phone'                 => 'required|string|max:15',
            'password'              => 'required|min:6|confirmed',
            'email'                 => 'required|email',
            'gender'                => 'required|in:male,female',
            'birthday'              => 'required|date',
            'address'               => 'required|string|max:255',
        ]);

        $digits = preg_replace('/\D/', '', $validated['phone']);

        if (str_starts_with($digits, '0')) {
            $digits = '63' . substr($digits, 1);
        }
        if (!str_starts_with($digits, '63')) {
            $digits = '63' . $digits;
        }
        $phone = $digits;

        // Generate & store OTP (5 min)
        $otpCode = (string) random_int(100000, 999999);
        $otpRecord = Otp::create([
            'phone_number' => $phone,
            'code'         => $otpCode,
            'expires_at'   => now()->addMinutes(5),
            'used'         => false,
        ]);

        // Save all needed registration data for the verify step
        $request->session()->put('registration_data', [
            'first_name' => $validated['first_name'],
            'last_name'  => $validated['last_name'],
            'phone'      => $phone,
            'password'   => $validated['password'],
            'email'      => $validated['email'] ?? null,
        ]);

        // Send SMS via IPROG
        $message = "Your OTP code is {$otpCode}. It will expire in 5 minutes.";
        $resp = $sms->sendSms($phone, $message);

        // In local/dev, allow flow to continue even if SMS fails
        if (app()->environment('local') && !$resp['ok']) {
            Log::warning('IPROG SMS failed in local; allowing flow.', ['resp' => $resp]);
            $resp['ok'] = true;
        }

        if (!$resp['ok']) {
            // Clean up OTP record if you want to be strict
            $otpRecord->delete();
            return response()->json([
                'status'  => 'error',
                'message' => 'Failed to send OTP. Please try again.'
            ], 200);
        }

        return response()->json([
            'status'      => 'ok',
            'pending_id'  => $otpRecord->id,
        ]);
    }

    /**
     * Step 2: Verify OTP, create/find user, return account_code JSON.
     */
    public function verifyOtp(Request $request)
    {
        $validated = $request->validate([
            'otp_code' => 'required|string|size:6',
            // optional 'pending_id' if you want to use it instead of session
            'pending_id' => 'nullable|integer',
        ]);

        $reg = $request->session()->get('registration_data');
        if (!$reg) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Registration data not found.',
            ], 422);
        }

        $phone = $reg['phone'];

        // Fetch a matching, unused, non-expired OTP
        $otp = Otp::where('phone_number', $phone)
            ->where('code', $validated['otp_code'])
            ->where('used', false)
            ->latest()
            ->first();

        if (!$otp || $otp->isExpired()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Invalid or expired OTP.',
            ], 422);
        }

        // Mark OTP as used
        $otp->used = true;
        $otp->save();

        // Determine final email
        $finalEmail = $reg['email'] ?? ($reg['phone'] . '@autogen.local');

        // Already exists?
        $existing = User::where('email', $finalEmail)->first();
        if ($existing) {
            $request->session()->forget('registration_data');
            return response()->json([
                'status'       => 'ok',
                'account_code' => $existing->account_code,
            ]);
        }

        // Generate simple account code: NN-LASTNAME
        $userNumber = User::count() + 1;
        $prefix = str_pad($userNumber, 2, '0', STR_PAD_LEFT);
        $accountCode = $prefix . '-' . strtoupper($reg['last_name']);

        // Create user
        $user = User::create([
            'name'         => $reg['first_name'] . ' ' . $reg['last_name'],
            'email'        => $finalEmail,
            'password'     => Hash::make($reg['password']),
            'account_code' => $accountCode,
        ]);

        $request->session()->forget('registration_data');

        return response()->json([
            'status'       => 'ok',
            'account_code' => $user->account_code,
        ]);
    }
}
