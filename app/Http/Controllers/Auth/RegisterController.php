<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PendingRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Show the registration form (the first slide: Get Started).
     */
    public function show()
    {
        return view('auth.register');
    }

    /**
     * Handle Step 1 ("Continue" button).
     *
     * What this does:
     * 1. Validate the form input.
     * 2. Generate an OTP code.
     * 3. Save everything into pending_registrations.
     * 4. Return a response that can show the OTP step.
     */
public function storeStep1(Request $request)
{
    $validatedData = $request->validate([
        'first_name'             => 'required|string|max:255',
        'last_name'              => 'required|string|max:255',
        'gender'                 => 'nullable|in:male,female',
        'birthday'               => 'nullable|date',
        'address'                => 'nullable|string|max:500',

        'email'                  => 'nullable|email|max:255',
        'phone'                  => 'required|string|max:20|unique:pending_registrations,phone',

        'password'               => 'required|min:6|confirmed',
    ]);

    $otp = strval(random_int(100000, 999999));

    $pending = \App\Models\PendingRegistration::create([
        'first_name' => $validatedData['first_name'],
        'last_name'  => $validatedData['last_name'],
        'gender'     => $validatedData['gender'] ?? null,
        'birthday'   => $validatedData['birthday'] ?? null,
        'address'    => $validatedData['address'] ?? null,

        'email'      => $validatedData['email'] ?? null,
        'phone'      => $validatedData['phone'],

        'password'   => \Illuminate\Support\Facades\Hash::make($validatedData['password']),
        'otp_code'   => $otp,
    ]);

    // ⬇⬇⬇ IMPORTANT ⬇⬇⬇
    // DO NOT: return view('auth.register', [...]);
    // INSTEAD: return JSON
    return response()->json([
        'status'      => 'ok',
        'pending_id'  => $pending->id,
        'otp_preview' => $otp,
    ]);
}



    /**
     * (NEXT STEP, not wired yet)
     * You'll add something like verifyOtp(Request $request)
     * to check the OTP, create the final user, and generate account number.
     */
}
