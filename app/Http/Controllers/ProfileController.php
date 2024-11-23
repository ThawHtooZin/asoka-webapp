<?php

namespace App\Http\Controllers;

use App\Models\BookPurchase;
use App\Models\CoursePurchase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $Courses = CoursePurchase::where('user_id', '=', $user->id)->where('status', '!=', 'achived')->orderByDesc('created_at')->get();
        $Books = BookPurchase::where('user_id', '=', $user->id)->where('status', '!=', 'achived')->orderByDesc('created_at')->get();
        return view('profile.index', compact('user', 'Courses', 'Books'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $user = User::find($request->id);

        if ($user) {
            $dataToUpdate = $request->only(['name', 'email', 'phone', 'address']);
            $user->update($dataToUpdate);

            session()->flash('success', 'Profile Updated successfully!');
            return redirect('/profile');
        }
    }
}
