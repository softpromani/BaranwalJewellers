<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    function list()
    {
        $categories = Banner::active()->get();

        return response()->json([
            'success' => true,
            'data' => $categories
        ], 200);
    }
}
