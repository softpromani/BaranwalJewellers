<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    function list()
    {
        $products = Product::active()->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $products
        ], 200);
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
