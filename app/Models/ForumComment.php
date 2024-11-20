<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumComment extends Model
{
    protected $guarded = [];

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    // A comment belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A comment can have many replies (replies to this comment)
    public function replies()
    {
        return $this->hasMany(ForumComment::class, 'parent_comment_id');
    }

    // A comment can have one parent (this is for replies to other comments)
    public function parent()
    {
        return $this->belongsTo(ForumComment::class, 'parent_id');
    }
}
