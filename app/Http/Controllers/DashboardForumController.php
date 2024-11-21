<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardForumController extends Controller
{
    public function index()
    {
        $forums = Forum::get();
        $users = User::get();
        return view('dashboard.forum', compact('forums', 'users'));
    }

    public function update(Request $request, $id)
    {
        // Find the forum by ID
        $forum = Forum::findOrFail($id);

        // Validate incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'by' => 'required|exists:users,id',
            'content' => 'required|string|min:10',
        ]);

        // Update the forum with validated data
        $forum->update([
            'title' => $validatedData['title'],
            'user_id' => $validatedData['by'],
            'content' => $validatedData['content'],
        ]);

        // Redirect back with success message
        return redirect()
            ->route('dashboard.forum.index')->with('success', 'Forum updated successfully!');
    }

    public function destroy(Request $request)
    {
        $forum = Forum::find($request->id);
        if ($forum) {
            $forum->delete();
            return redirect()->back()->with('success', 'Forum deleted successfully!');
        }
        return redirect()->back()->with('error', 'Forum not found');
    }
}
