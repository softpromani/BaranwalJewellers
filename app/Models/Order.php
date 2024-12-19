<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}
