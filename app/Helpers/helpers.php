<?php

use App\Models\MetalCaratRate;

if (!function_exists('greet')) {
    function greet($name)
    {
        return "Hello, " . ucfirst($name) . "!";
    }
}

if (!function_exists('getCaratPrice')) {
    function getCaratPrice($metal_id, $carat_id)
    {
        $carat = MetalCaratRate::where('metal_id', $metal_id)->where('carat_id', $carat_id)->first();
        $price = isset($carat) ? $carat->price : 0.0;
        return $price;
    }
}
