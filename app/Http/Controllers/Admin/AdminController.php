<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function dashboard()
    {
        return view('admin.dashboard');
    }

    function abandonedCart()
    {
        return view('admin.abandoned-cart');
    }

    function orderList()
    {
        return view('admin.order.list');
    }

    function orderDetail($order_id)
    {
        return view('admin.order.detail');
    }

    function cartDetail($user_id)
    {
        return view('admin.cart-details');
    }

    function customerList(Request $request)
    {
        $query = User::query()->active();
        if($request->name){
            $query->where('name', 'like', '%'.$request->name.'%');
        }
        if($request->phone){
            $query->where('phone', $request->phone);
        }

        $users = $query->paginate(10);
        return view('admin.customer.list', compact('users'));
    }
}
