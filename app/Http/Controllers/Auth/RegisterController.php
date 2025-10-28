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

    /**
     * Handle Step 1 ("Continue"): validate, save pending_registrations, generate OTP.
     * Returns JSON now (no page reload).
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

        // Generate 6-digit OTP
        $otp = strval(random_int(100000, 999999));

        // Save pending registration
        $pending = PendingRegistration::create([
            'first_name' => $validatedData['first_name'],
            'last_name'  => $validatedData['last_name'],
            'gender'     => $validatedData['gender'] ?? null,
            'birthday'   => $validatedData['birthday'] ?? null,
            'address'    => $validatedData['address'] ?? null,

            'email'      => $validatedData['email'] ?? null,
            'phone'      => $validatedData['phone'],

            'password'   => Hash::make($validatedData['password']),
            'otp_code'   => $otp,
        ]);

        return response()->json([
            'status'      => 'ok',
            'pending_id'  => $pending->id,
            'otp_preview' => $otp, // dev only: show on screen
        ]);
    }

    public function verifyOtp(Request $request)
    {
        // 1. Validate incoming request
        $validated = $request->validate([
            'pending_id' => 'required|integer|exists:pending_registrations,id',
            'otp_code'   => 'required|string|size:6',
        ]);

        // 2. Load pending record
        $pending = PendingRegistration::find($validated['pending_id']);

        // 3. Check OTP
        if ($pending->otp_code !== $validated['otp_code']) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Invalid OTP.',
            ], 422);
        }

        // 4. Decide what email we’ll store in users.email
        //    - If the user entered an email, use it
        //    - If not, we auto-generate a fallback email to make it unique
        //      because "users.email" column is unique and cannot be null or reused
        $finalEmail = $pending->email ?? ($pending->phone . '@autogen.local');

        // 5. Check if this user already exists (e.g. they clicked Verify twice)
        $existingUser = User::where('email', $finalEmail)->first();

        if ($existingUser) {
            // User already created before, so just return their account_code.
            return response()->json([
                'status'        => 'ok',
                'account_code'  => $existingUser->account_code,
            ]);
        }

        // 6. Generate their unique account_code for login
        // Format: "01-RIVERA"
        // "01" is (total users + 1) padded to 2 digits
        $userNumber = User::count() + 1; // e.g. first user => 1, second => 2
        $prefix = str_pad($userNumber, 2, '0', STR_PAD_LEFT); // "01", "02", etc.
        $accountCode = $prefix . '-' . strtoupper($pending->last_name); // "01-RIVERA"

        // 7. Create a new real user in `users` table
        $user = User::create([
            'name'         => $pending->first_name . ' ' . $pending->last_name,
            'email'        => $finalEmail,
            'password'     => $pending->password, // already hashed in step1
            'account_code' => $accountCode,
        ]);

        // (Optional) If you want to mark that this pending registration is "used"
        // you could add a column later like `verified_at` or `user_id` and update it here.

        // 8. Return the info back to frontend
        return response()->json([
            'status'        => 'ok',
            'account_code'  => $user->account_code,
        ]);
    }
}
