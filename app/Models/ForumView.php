<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumView extends Model
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
}
