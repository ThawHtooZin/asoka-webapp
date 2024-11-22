<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $guarded = [];
    public function comments()
    {
        return $this->hasMany(ForumComment::class);
    }

    // A forum belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function views()
    {
        return $this->hasMany(ForumView::class, 'forum_id');
    }
}
