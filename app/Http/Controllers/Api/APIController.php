<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;

class APIController extends Controller
{
    function businessSetting()
    {
        $admin = User::find(1);
        $data = [
            'app_logo' => $admin->image_url,
            'about' => $admin->about,
            'company' => $admin->company,
            'address' => $admin->address,
            'phone' => $admin->phone
        ];

        return $data;
    }

    function userCart()
    {
        $cart = Cart::with('product')->where('user_id', auth('api')->user()->id)->get();

        if($cart)
        {
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully',
                'data' => $cart
            ], 200);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
                'data' => Null
            ], 200);
        }
    }

    function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);

        $data = [
            'user_id' => auth('api')->user()->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => $request->price
        ];

        $cart = Cart::create($data);

        if($cart)
        {
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully',
                'data' => $cart
            ], 200);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
                'data' => Null
            ], 200);
        }
    }

    public function placeOrder(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id', // Ensure the user exists
            'products' => 'required|array', // Products should be an array
            'products.*.product_id' => 'required|exists:products,id', // Each product must exist
            'products.*.quantity' => 'required|integer|min:1', // Quantity validation
            'products.*.price' => 'required|numeric|min:0', // Price validation
        ]);

        try {
            // Calculate total order amount
            $orderAmount = collect($request->products)->sum(function ($product) {
                return $product['quantity'] * $product['price'];
            });

            // Create an Order
            $order = Order::create([
                'user_id' => auth('api')->user()->id,
                'order_id' => uniqid('ORD-'),
                'order_status' => 'pending',
                'payment_status' => 'unpaid',
                'order_amount' => $orderAmount,
                'payment_method' => 'cash_on_delivery',
                'payment_note' => $request->payment_note ?? null,
            ]);

            // Save Order Details
            foreach ($request->products as $product) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $product['product_id'],
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                    'delivery_status' => 'pending',
                    'payment_status' => 'unpaid',
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully!',
                'order_id' => $order->order_id,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to place order!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
