<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'phone' => 'required|string|unique:users',
                'address' => 'required|string|max:255',
                'password' => 'required|string|min:8|confirmed',
            ],
            [
                // Name field messages
                'name.required' => 'Please provide your name.',
                'name.string' => 'The name must be a valid string.',
                'name.max' => 'The name must not exceed 255 characters.',

                // Email field messages
                'email.required' => 'Email is required.',
                'email.email' => 'Please enter a valid email address.',
                'email.unique' => 'This email is already registered.',

                // Phone field messages
                'phone.required' => 'Phone number is required.',
                'phone.unique' => 'This phone number is already registered.',

                // Address field messages
                'address.required' => 'Please provide your address.',
                'address.max' => 'The address must not exceed 255 characters.',

                // Password field messages
                'password.required' => 'Password is required.',
                'password.min' => 'The password must be at least 8 characters long.',
                'password.confirmed' => 'The password confirmation does not match.',
            ]
        );


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => bcrypt($request->password),
        ]);

        $user->roles()->attach(3);

        Auth::login($user);

        session()->flash('success', 'Registered Successfully!');
        return redirect('/');
    }
}
