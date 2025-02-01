<?php

use App\Models\BusinessSetting;
use App\Models\MetalCaratRate;
use Illuminate\Support\Facades\Http;

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

if (!function_exists('getBusinessSetting')) {
    function getBusinessSetting($key)
    {
        $setting = BusinessSetting::where('key', $key)->first();
        if($setting){
            return $setting->value;
        } else {
            return Null;
        }
    }
}

if (!function_exists('getLiveRate')) {
    function getLiveRate($key)
    {
        $setting = BusinessSetting::where('key', $key)->first();
        if($setting){
            return $setting->value;
        } else {
            return 0.0;
        }
    }
}

if (!function_exists('fetchAuthorityRates')) {
    function fetchAuthorityRates()
    {
        $apiUrl = 'https://api.metals.dev/v1/metal/authority';
        $apiKey = 'DRHVDSWOHDIUJOCERPSW593CERPSW';

        // Get parameters from the request or set defaults
        $authority = 'mcx';
        $currency = 'INR';
        $unit = 'g';

        // Make the API request
        $response = Http::get($apiUrl, [
            'api_key' => $apiKey,
            'authority' => $authority,
            'currency' => $currency,
            'unit' => $unit,
        ]);

        // Handle the API response
        if ($response->successful()) {
            $responseData = $response->json();

            BusinessSetting::updateOrCreate(['key'=>'mcx_gold_rate'],['value'=>$responseData['rates']['mcx_gold']]);
            BusinessSetting::updateOrCreate(['key'=>'mcx_silver_rate'],['value'=>$responseData['rates']['mcx_silver']]);

            return response()->json([
                'success' => true,
                'data' => $response->json(),
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch authority rates',
                'error' => $response->body(),
            ], $response->status());
        }
    }
}

if (!function_exists('fetchMetalsDevUsage')) {
    function fetchMetalsDevUsage()
    {
        $apiUrl = 'https://api.metals.dev/usage';
        $apiKey = 'DRHVDSWOHDIUJOCERPSW593CERPSW';

        // Make the API request
        $response = Http::get($apiUrl, [
            'api_key' => $apiKey,
        ]);

        // Handle the API response
        if ($response->successful()) {
            $responseData = $response->json();

            // Optional: Log the usage data or store it in a database if needed
            // Example:
            // Usage::create(['data' => json_encode($responseData)]);

            return response()->json([
                'success' => true,
                'data' => $responseData,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch usage data',
                'error' => $response->body(),
            ], $response->status());
        }
    }
}
