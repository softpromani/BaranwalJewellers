<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function orderList()
    {
        $orders = Order::get();
        return view('admin.order.list', compact('orders'));
    }

    function orderDetail($order_id)
    {
        $order = Order::find($order_id);
        return view('admin.order.detail', compact('order'));
    }
}
