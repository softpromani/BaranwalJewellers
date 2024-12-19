<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $guarded = [];
    function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
