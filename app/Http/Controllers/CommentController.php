<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\ForumComment;
use Egulias\EmailValidator\Parser\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Forum $forum)
    {
        // Validate the request
        $request->validate([
            'comment' => 'required|string',
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

    public function update(Request $request, $forumId, $commentId)
    {
        // Validate the comment input
        $request->validate([
            'comment' => 'required|string',
        ]);

        // Find the comment by its ID and make sure it belongs to the correct forum
        $comment = ForumComment::where('id', $commentId)->where('forum_id', $forumId)->first();

        // If comment is found, update it
        if ($comment) {
            $comment->update([
                'comment' => $request->input('comment'),
            ]);

            // Optionally, you can redirect or return a success message
            return redirect()->route('forum.show', $forumId)->with('success', 'Comment updated successfully.');
        }

        // If comment not found, handle the error
        return redirect()->route('forum.show', $forumId)->with('error', 'Comment not found.');
    }

    public function destroy($forumId, $commentId)
    {
        // Find the comment and ensure it belongs to the correct forum
        $comment = ForumComment::where('id', $commentId)->where('forum_id', $forumId)->first();

        // If comment is found, delete it
        if ($comment) {
            $comment->delete();

            // Redirect back with a success message
            return redirect()->route('forum.show', $forumId)->with('success', 'Comment deleted successfully.');
        }

        // If comment not found, handle the error
        return redirect()->route('forum.show', $forumId)->with('error', 'Comment not found.');
    }
}
