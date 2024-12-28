<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Carat;
use App\Models\Cart;
use App\Models\Metal;
use App\Models\MetalCaratRate;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
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
            'phone' => $admin->phone,
            'alternate_number' => $admin->alternate_number,
            'gold_24k' => getCaratPrice(1,1),
            'gold_22k' => getCaratPrice(1,2),
            'gold_18k' => getCaratPrice(1,3),
            'economic_calendar' => '<!DOCTYPE html>
                                    <html>
                                    <head>
                                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                        <style>
                                        body { margin: 0; padding: 0; }
                                        iframe { width: 100%; height: 50rem; border: none; }
                                        </style>
                                    </head>
                                    <body>
                                        <iframe src="https://sslecal2.investing.com?columns=exc_flags,exc_currency,exc_importance,exc_actual,exc_forecast,exc_previous&features=datepicker,timezone&countries=25,32,6,37,72,22,17,39,14,10,35,43,56,36,110,11,26,12,4,5&calType=week&timeZone=8&lang=1" allowtransparency="true" marginwidth="0" marginheight="0"></iframe>
                                        <div style="font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #333333; text-align: center;">
                                        Real Time Economic Calendar provided by
                                        <a href="https://www.investing.com/" rel="nofollow" target="_blank" style="color: #06529D; font-weight: bold; text-decoration: none;">
                                            Investing.com
                                        </a>.
                                        </div>
                                    </body>
                                    </html>',
        ];

        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }

    function userCart()
    {
        $cart = Cart::with('product')->where('user_id', auth('api')->user()->id)->get();

        if ($cart) {
            return response()->json([
                'success' => true,
                'message' => 'Cart fetched successfully',
                'data' => $cart
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
                'data' => Null
            ], 200);
        }
    }

    function addToCart(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], status: 422);
        }

        $existProduct = Cart::where('user_id', auth('api')->user()->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($existProduct) {
            return response()->json([
                'success' => false,
                'message' => 'Product already added!',
                'data' => Null
            ], 200);
        } else {
            $product_price = $request->price * $request->quantity;
            $data = [
                'user_id' => auth('api')->user()->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => $product_price
            ];

            $cart = Cart::create($data);

            if ($cart) {
                return response()->json([
                    'success' => true,
                    'message' => 'Product added to cart successfully',
                    'data' => $cart
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong!',
                    'data' => Null
                ], 200);
            }
        }
    }

    public function placeOrder(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
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
                'order_id' => 'ORD-' . (Order::latest()->first()?->id + 1 ?? 1),
                'order_status' => 'pending',
                'payment_status' => 'unpaid',
                'order_amount' => $orderAmount,
                'discount_amount' => isset($request->discount_amount) ? $request->discount_amount :  0.00,
                'payment_method' => 'cash_on_delivery',
                'payment_note' => $request->payment_note ?? null,
            ]);

            // Save Order Details
            foreach ($request->products as $product) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $product['product_id'],
                    'quantity' => $product['quantity'],
                    'price' => $product['price'] * $product['quantity'],
                    'delivery_status' => 'pending',
                    'payment_status' => 'unpaid',
                ]);
            }

            Cart::where('user_id', auth('api')->user()->id)->delete();

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

    public function removeFromCart($id)
    {
        $removecart = Cart::find($id);
        if ($removecart) {
            Cart::find($id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Product remove from cart successfully',
                'data' => $removecart
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cart not found!',
                'data' => Null
            ], 200);
        }
    }

    public function get_order(){

        $order = Order::with('order_details')
                ->where('user_id', auth('api')->user()->id)
                ->latest()
                ->get();

        if ($order) {
            return response()->json([
                'success' => true,
                'message' => 'Order fetched successfully',
                'data' => $order
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
                'data' => Null
            ], 200);
        }
    }

    function caratList()
    {
        $data = Carat::get();

        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'Carat fetched successfully',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
                'data' => Null
            ], 200);
        }
    }

    function calculateGoldRate(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'carat_id' => 'required',
            'weight' => 'required|numeric',
            'making_charge' => 'required|numeric',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validate->errors(),
            ], 422);
        }

        $validateData = $validate->validated();
        $gst_percentage = 3; // GST percentage
        $final_amount = 0.0;

        // Fetch the metal data and calculate gold weight amount
        $metal = Metal::find(1);
        $gold_amount = MetalCaratRate::where('metal_id', $metal->id)
            ->where('carat_id', $validateData['carat_id'])
            ->first();

        if (!$gold_amount) {
            return response()->json([
                'success' => false,
                'message' => 'Metal carat rate not found!',
                'data' => null,
            ], 404);
        }

        // Calculations
        $gold_weight_amount = $gold_amount->price * $validateData['weight'];
        $making_charge_amount = $gold_weight_amount * ($validateData['making_charge'] / 100);
        $gst_charge_amount = ($gold_weight_amount + $making_charge_amount) * ($gst_percentage / 100);
        $final_amount = $gold_weight_amount + $making_charge_amount + $gst_charge_amount;

        // Formatting the final amount to 2 decimal places
        $final_amount = number_format($final_amount, 2, '.', '');

        // Bifurcation details
        $bifurcation = [
            'gold_weight' => $validateData['weight'],
            'gold_weight_amount' => number_format($gold_weight_amount, 2, '.', ''),
            'making_charge_percentage' => $validateData['making_charge'],
            'making_charge_amount' => number_format($making_charge_amount, 2, '.', ''),
            'gst_percentage' => $gst_percentage,
            'gst_charge_amount' => number_format($gst_charge_amount, 2, '.', ''),
            'final_amount' => $final_amount,
        ];

        return response()->json([
            'success' => true,
            'message' => 'Rate calculated successfully',
            'data' => $bifurcation,
        ], 200);
    }

    function notifications()
    {
        $data = Notification::latest()->take(20)->get();
        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'Notification fetched successfully',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
                'data' => Null
            ], 200);
        }
    }

    function liveRate()
    {
        $data = [
            'gold' => [
                'low' => getLiveRate('mcx_gold_rate'),
                'high' => getLiveRate('mcx_gold_rate'),
                'current' => getLiveRate('mcx_gold_rate'),
            ],
            'silver' => [
                'low' => getLiveRate('mcx_silver_rate'),
                'high' => getLiveRate('mcx_silver_rate'),
                'current' => getLiveRate('mcx_silver_rate'),
            ],
            'silver_jewellery' => [
                'low' => getLiveRate('silver_jewellery'),
                'high' => getLiveRate('silver_jewellery'),
                'current' => getLiveRate('silver_jewellery'),
            ],
            'gold_jewellery_99' => [
                'low' => getLiveRate('gold_jewellery_99'),
                'high' => getLiveRate('gold_jewellery_99'),
                'current' => getLiveRate('gold_jewellery_99'),
            ],
            'gold_jewellery_24k_999_rtgs_bank' => [
                'low' => getLiveRate('gold_jewellery_24k'),
                'high' => getLiveRate('gold_jewellery_24k'),
                'current' => getLiveRate('gold_jewellery_24k'),
            ],
            'gold_jewellery_22k_916' => [
                'low' => getLiveRate('gold_jewellery_22k'),
                'high' => getLiveRate('gold_jewellery_22k'),
                'current' => getLiveRate('gold_jewellery_22k'),
            ],
            'gold_jewellery_18k_750' => [
                'low' => getLiveRate('gold_jewellery_18k'),
                'high' => getLiveRate('gold_jewellery_18k'),
                'current' => getLiveRate('gold_jewellery_18k'),
            ],
            'gold_costing' => [
                'low' => getLiveRate('gold_costing'),
                'high' => getLiveRate('gold_costing'),
                'current' => getLiveRate('gold_costing'),
            ],
            'silver_costing' => [
                'low' => getLiveRate('silver_costing'),
                'high' => getLiveRate('silver_costing'),
                'current' => getLiveRate('silver_costing'),
            ],
        ];

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

}
