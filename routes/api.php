<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;


//LoginOrRegister
Route::post('/login', [LoginController::class, 'loginOrRegister']);

//profileUpdate
Route::post('/profile-update', [UserController::class, 'profile_update']);

//Category
Route::get('category/list', [CategoryController::class, 'list']);

//Banner
Route::get('banner/list', [BannerController::class, 'list']);

//Product
Route::get('product/list', [ProductController::class, 'list']);


