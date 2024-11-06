<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $guarded = [];

    public function chapters()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function courses()
    {
        return $this->belongsTo(Course::class);
    }
}
