<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show login form (GET /login)
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Handle login submit (POST /login)
     */
    public function authenticate(Request $request)
    {
        // 1. Validate inputs from the form
        $credentials = $request->validate([
            'name' => ['required', 'string'],      // <- using 'name' as the account ID / username
            'password' => ['required', 'string'],
        ]);

        // 2. Attempt login using 'name' and 'password'
        // remember checkbox still optional
        if (Auth::attempt(
            [
                'name' => $credentials['name'],
                'password' => $credentials['password'],
            ],
            $request->boolean('remember')
        )) {
            // 3. Protect against session fixation
            $request->session()->regenerate();

            // 4. Send them to scholarship page
            return redirect()->intended(route('scholarship'));
        }

        // 5. Failed login -> send back with error, keep the name field filled
        return back()->withErrors([
            'name' => 'Invalid ID or password.',
        ])->onlyInput('name');
    }

    /**
     * Logout (optional)
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
