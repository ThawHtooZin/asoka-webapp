<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with Category model
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
