<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with Category model
    public function category()
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id');
    }
}
