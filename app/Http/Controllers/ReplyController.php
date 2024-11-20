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

        return back();
    }
}
