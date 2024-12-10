<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Support\Facades\Route;

//LoginOrRegister
Route::post('/login', [LoginController::class, 'loginOrRegister']);

//Category
Route::get('category/list', [CategoryController::class, 'list']);

//Banner
Route::get('banner/list', [BannerController::class, 'list']);

