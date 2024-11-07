<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chapter extends Model
{
    protected $guarded = [];

    public function courses()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }


    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
