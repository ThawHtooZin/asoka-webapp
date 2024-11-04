<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::get();
        return view('dashboard.role', compact('roles'));
    }

    public function store(Request $request)
    {
        $role = $request->validate([
            'name' => 'required',
        ]);

        Role::create($role);

        session()->flash('success', value: 'Role Created Successfully!');
        return redirect('/dashboard/roles');
    }


    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $role = Role::find($request->id);

        if ($role) {
            $dataToUpdate = $request->only(['name']);
            $role->update($dataToUpdate);

            session()->flash('success', 'Role updated successfully!');
            return redirect('/dashboard/roles');
        }

        session()->flash('error', 'User not found');
        return redirect('/dashboard/roles');
    }
    public function destroy(Request $request)
    {
        $role = Role::find($request->id);
        $role->delete();
        return redirect()->back();
    }
}
