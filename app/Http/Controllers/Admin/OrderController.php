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
        $order = Order::with('order_details')->find($order_id);
        return view('admin.order.detail', compact('order'));
    }

    public function updateOrderStatus( Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['status'=>0, 'message' => 'Order not found!'], 404);
        }

        $order->order_status = $request->status; 
        $order->save();

        return response()->json(['status' => 1,'message' => 'Order status updated!', 'order' => $order], 200);
    }
}
