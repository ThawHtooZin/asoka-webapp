<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|string|min:8',
            ],
            [
                // Custom messages for email field
                'email.required' => 'The email field is mandatory. Please provide your email address.',
                'email.email' => 'The email must be a valid email address.',

                // Custom messages for password field
                'password.required' => 'The password field is required.',
                'password.string' => 'The password must be a valid string.',
                'password.min' => 'The password must be at least 8 characters long.',
            ]
        );

        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            // Login successful
            $request->session()->regenerate(); // Optional: protects against session fixation attacks
            $user = User::where('email', $credentials['email'])->first();
            session()->flash('success', 'Logged In Successfully!');
            if ($user->roles()->first()->name != 'admin') {
                return redirect()->intended('/');
            } else {
                return redirect()->intended('/dashboard');
            }
        }

        // Login failed
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();
        session()->flash('success', 'Logged Out Successfully!');
        return redirect('/');
    }
}
