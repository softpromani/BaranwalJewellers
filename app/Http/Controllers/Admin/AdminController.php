<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function dashboard()
    {
        $cartUsers = User::has('carts')->with('carts')->latest()->take(5);
        $orders = Order::with('order_details')->latest()->take(5);
        return view('admin.dashboard', compact('cartUsers', 'orders'));
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
