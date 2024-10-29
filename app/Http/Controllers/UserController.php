<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::get();
        return view('dashboard.user', compact('users', 'roles'));
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
    public function destory(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
        return redirect()->back();
    }
}
