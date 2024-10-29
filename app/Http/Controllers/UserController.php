<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('dashboard.user', compact('users'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::find($request->id);

        if ($user) {
            $user->update($request->all());
        }
    }
    public function destory(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
        return redirect()->back();
    }
}
