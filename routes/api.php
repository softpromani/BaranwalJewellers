<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Api\APIController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;


//LoginOrRegister
Route::post('/login', [LoginController::class, 'loginOrRegister']);

//Business Setting
Route::get('business-setting', [APIController::class, 'businessSetting']);

Route::middleware(['auth:api'])->group(function () {
    // User Profile
    Route::get('user-profile', [UserController::class, 'user_profile']);

    //profileUpdate
    Route::post('/profile-update', [UserController::class, 'profile_update']);

    //profile picture update
    Route::post('/profile-picture-update', [UserController::class, 'profile_picture_update']);

    //Category
    Route::get('category/list', [CategoryController::class, 'list']);

    //Product List
    Route::get('product/list', [ProductController::class, 'list']);

    //Product Search
    Route::get('product/search', [ProductController::class, 'productSearch']);

    //Single Product
    Route::get('product/{id}', [ProductController::class, 'singleProduct']);

    //Product via category
    Route::get('product/category/{id}', [ProductController::class, 'listProductViaCategory']);

    //Carat List
    Route::get('carat/list', [APIController::class, 'caratList']);

    //Calculate Gold Rate
    Route::post('calculate-rate', [APIController::class, 'calculateGoldRate']);

    //Live Rate
    Route::get('live-rate', [APIController::class, 'liveRate']);

    //Banner
    Route::get('banner/list', [BannerController::class, 'list']);

    //user-cart
    Route::post('/user-cart', [APIController::class, 'userCart']);

    //add-to-cart
    Route::post('/add-cart', [APIController::class, 'addToCart']);

    //place-order
    Route::post('/place-order', [APIController::class, 'placeOrder']);

    //remove-cart
    Route::post('/remove-cart/{id}', [APIController::class, 'removeFromCart']);

    //get-order
    Route::get('/get-order', [APIController::class, 'get_order']);

    //get-order
    Route::get('/notifications', [APIController::class, 'notifications']);

});
