<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    function abandonedCart()
    {
        $users = User::has('carts')->with('carts')->get();
        return view('admin.abandoned-cart', compact('users'));
    }

    function cartDetail($user_id)
    {
        $carts = Cart::where('user_id', $user_id)->get();
        return view('admin.cart-details', compact('carts'));
    }
}
