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
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            // Login successful
            $request->session()->regenerate(); // Optional: protects against session fixation attacks
            $user = User::where('email', $credentials['email'])->first();
            session()->flash('success', 'Logged In Successfully!');
            if ($user->roles()->first()->name == 'student') {
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
