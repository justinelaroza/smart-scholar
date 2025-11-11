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

    public function authenticate(Request $request)
    {
        // Validate the incoming login data
        $credentials = $this->validateLogin($request);

        // Attempt to log the user in
        if ($this->attemptLogin($credentials, $request)) {
            $request->session()->regenerate();

            return $this->respondSuccess($request);
        }

        // If login fails
        return $this->respondFailure($request);
    }

    protected function validateLogin(Request $request): array
    {
        return $request->validate([
            'account_code' => 'required|string|max:255',
            'password'     => 'required|string|max:255',
        ]);
    }

    protected function attemptLogin(array $credentials, Request $request): bool
    {
        return Auth::attempt([
            'account_code' => $credentials['account_code'],
            'password'     => $credentials['password'],
        ], $request->boolean('remember'));
    }

    protected function respondSuccess(Request $request)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'status'  => 'ok',
                'message' => 'Login successful.',
            ]);
        }

        return redirect()->intended(route('home'))->with('success', 'Login successful');
    }

    protected function respondFailure(Request $request)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Invalid Account ID or password.',
            ], 401);
        }

        return back()
            ->withErrors(['invalid' => 'Invalid Account ID or password.'])
            ->onlyInput('account_code');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
