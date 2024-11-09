<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with Category model
    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'course_category_id');
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function purchased()
    {
        return $this->hasOne(CoursePurchase::class)->where('user_id', auth()->id());
    }
}
