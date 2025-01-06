<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    function singleProduct($id)
    {
        $product = Product::active()->with(['metal', 'carat'])->find($id);
        if($product){
            return response()->json([
                'success' => true,
                'data' => $product
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'data' => Null
            ], 200);
        }
    }

    function list()
    {
        $products = Product::active()->paginate(10);

        if($products){
            return response()->json([
                'success' => true,
                'data' => $products
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'data' => Null
            ], 200);
        }
    }

    function productSearch(Request $request)
    {
        $products = Product::active()
            ->where('name', 'like', '%' . $request->name . '%')
            ->orWhere('description', 'like', '%' . $request->name . '%')
            ->get()
            ->map(function ($product) {
                $product->description = strip_tags($product->description); // Strip HTML tags
                return $product;
            });

        if($products){
            return response()->json([
                'success' => true,
                'data' => $products
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'data' => []
            ], 200);
        }

    }

    function listProductViaCategory($category_id)
    {
        $products = Product::where('category_id', $category_id)->active()->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $products
        ], 200);
    }
}
