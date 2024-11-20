<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Forum $forum)
    {
        // Validate the request
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        // Create the comment
        $forum->comments()->create([
            'forum_id' => $forum->id, // Use the correct forum ID
            'user_id' => auth()->id(), // Authenticated user ID
            'comment' => $request->comment, // Comment from the request
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Comment posted successfully!');
    }
}
