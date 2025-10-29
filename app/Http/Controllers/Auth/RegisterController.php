<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PendingRegistration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Show the registration form (panel 1).
     */
    public function show()
    {
        return view('auth.register');
    }

    public function storeStep1(Request $request)
    {
        $validatedData = $request->validate([
            'first_name'             => 'required|string|max:255',
            'last_name'              => 'required|string|max:255',
            'gender'                 => 'nullable|in:male,female',
            'birthday'               => 'nullable|date',
            'address'                => 'nullable|string|max:500',
            'email'                  => 'nullable|email|max:255',
            'phone'                  => 'required|string|max:20',
            'password'               => 'required|min:6|confirmed',
        ]);

        // Generate 6-digit OTP
        $otp = strval(random_int(100000, 999999));

        $request->session()->put('registration_data', array_merge($validatedData, [
            'otp_code' => $otp,
        ]));

        return response()->json([
            'status'      => 'ok',
            'otp_preview' => $otp, // dev only: show on screen
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $validated = $request->validate([
            'otp_code' => 'required|string|size:6',
        ]);

          $registrationData = $request->session()->get('registration_data');

         if (!$registrationData) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Registration data not found.',
            ], 422);
        }

          if ($registrationData['otp_code'] !== $validated['otp_code']) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Invalid OTP.',
            ], 422);
        }

        $finalEmail = $registrationData['email'] ?? ($registrationData['phone'] . '@autogen.local');

        $existingUser = User::where('email', $finalEmail)->first();
            if ($existingUser) {
                return response()->json([
                    'status'        => 'ok',
                    'account_code'  => $existingUser->account_code,
                ]);
            }

        $userNumber = User::count() + 1;
        $prefix = str_pad($userNumber, 2, '0', STR_PAD_LEFT);
        $accountCode = $prefix . '-' . strtoupper($registrationData['last_name']);

        $user = User::create([
            'name'         => $registrationData['first_name'] . ' ' . $registrationData['last_name'],
            'email'        => $finalEmail,
            'password'     => Hash::make($registrationData['password']),
            'account_code' => $accountCode,
        ]);

         $request->session()->forget('registration_data');

        return response()->json([
            'status'        => 'ok',
            'account_code'  => $user->account_code,
        ]);
    }
}
