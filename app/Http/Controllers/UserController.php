<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        $roles = Role::get();
        return view('dashboard.user', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'role' => 'required|exists:roles,id',
            'password' => 'required|string|min:8',
        ]);

        // Create the user with bcrypt for password hashing
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
            'password' => bcrypt($validatedData['password']),
        ]);

        $user->roles()->attach($validatedData['role']);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'User added successfully!');
    }


    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'role' => 'required|exists:roles,id',
        ]);

        $user = User::find($request->id);

        if ($user) {
            $dataToUpdate = $request->only(['name', 'email', 'phone']);
            $user->update($dataToUpdate);

            $user->roles()->sync([$request->role]);

            session()->flash('success', 'User updated successfully!');
            return redirect('/dashboard/users');
        }

        session()->flash('error', 'User not found');
        return redirect('/dashboard/users');
    }
    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        if ($user) {
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully!');
        }
        return redirect()->back()->with('error', 'User not found');
    }
}
