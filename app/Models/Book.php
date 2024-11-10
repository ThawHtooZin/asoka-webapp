<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    protected $guarded = [];
    public function category()
    {
        return $this->belongsTo(BookCategory::class, 'book_category_id');
    }

    public function bookpurchases()
    {
        return $this->hasMany(BookPurchase::class);
    }

    public function purchased()
    {
        return $this->hasOne(BookPurchase::class)->where('user_id', auth()->id());
    }
}
