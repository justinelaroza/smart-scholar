<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
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
            'account_code' => ['required|string|max:255'], 
            'password' => ['required|string|max:255'],
        ]);

        // 2. Attempt login using 'account_code' and 'password'
        if (Auth::attempt(
            [
                'account_code' => $credentials['account_code'],  // <- Use 'account_code' here
                'password' => $credentials['password'],
            ],
            $request->boolean('remember')
        )) {
            // 3. Protect against session fixation
            $request->session()->regenerate();

            // 4. Send them to the intended page or scholarship page
            return redirect()->intended(route('home'));
        }

        // 5. Failed login -> send back with error, keep the name field filled
        return back()->withErrors(['invalid' => 'Invalid Account ID or password.',])->onlyInput('account_code');  // <- Keep 'account_code' input filled on error
    } 

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
