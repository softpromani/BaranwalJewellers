<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];
    function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
