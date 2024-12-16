<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
