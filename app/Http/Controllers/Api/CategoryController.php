<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function list()
    {
        $categories = Category::active()->orderBy('sequence')->get();

        return response()->json([
            'success' => true,
            'data' => $categories
        ], 200);
    }
}
