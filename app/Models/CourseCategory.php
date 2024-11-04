<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    protected $guarded = [];

    public function article()
    {
        return $this->hasMany(Article::class,);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
