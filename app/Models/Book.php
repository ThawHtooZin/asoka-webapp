<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    protected $guarded = [];
    public function category()
    {
        return $this->belongsTo(BookCategory::class);
    }

    public function bookpurchases()
    {
        return $this->hasMany(BookPurchase::class);
    }
}
