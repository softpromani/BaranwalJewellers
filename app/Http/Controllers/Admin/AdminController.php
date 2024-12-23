<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function dashboard()
    {
        $carts = Cart::latest()->take(5)->get();
        $orders = Order::with('order_details')->latest()->take(5)->get();
        $data = fetchAuthorityRates();
        return view('admin.dashboard', compact('carts', 'orders'));
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
