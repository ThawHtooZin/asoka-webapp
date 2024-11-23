<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\ForumComment;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request, $forumId, $commentId)
    {
        $validated = $request->validate([
            'comment' => 'required|string',
        ]);

        // Find the forum and the parent comment
        $forum = Forum::findOrFail($forumId);

        // Store the reply as a new comment
        $reply = new ForumComment();
        $reply->user_id = auth()->id();
        $reply->forum_id = $forum->id;
        $reply->parent_comment_id = $request->parent_id;
        $reply->comment = $validated['comment'];
        $reply->save();

        return redirect()->back()->with('success', 'Reply posted successfully!');
    }

    public function update(Request $request, $forumId, $commentId)
    {
        // Validate the comment input
        $request->validate([
            'reply' => 'required|string',
        ]);

        // Find the comment by its ID and make sure it belongs to the correct forum
        $comment = ForumComment::where('id', $commentId)->where('forum_id', $forumId)->first();

        // If comment is found, update it
        if ($comment) {
            $comment->update([
                'comment' => $request->input('reply'),
            ]);

            // Optionally, you can redirect or return a success message
            return redirect()->route('forum.show', $forumId)->with('success', 'Reply updated successfully.');
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
            return redirect()->route('forum.show', $forumId)->with('success', 'Reply deleted successfully.');
        }

        // If comment not found, handle the error
        return redirect()->route('forum.show', $forumId)->with('error', 'Comment not found.');
    }
}
