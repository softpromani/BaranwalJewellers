<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('home');
Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
Route::post('/change-password', [AuthController::class, 'changePassword'])->name('admin.change_password');


Route::group([ 'name' => 'admin', 'prefix' => 'admin', 'as' => 'admin.'], function(){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::resource('category', CategoryController::class);
    Route::resource('banner', BannerController::class);
    Route::resource('product', ProductController::class);

    Route::get('abandoned-cart', [AdminController::class, 'abandonedCart'])->name('abandonedCart');
    Route::get('order-list', [AdminController::class, 'orderList'])->name('orderList');
    Route::get('order-detail/{id}', [AdminController::class, 'orderDetail'])->name('orderDetail');
    Route::get('cart-detail/{id}', [AdminController::class, 'cartDetail'])->name('cartDetail');

    Route::get('customer-list', [AdminController::class, 'customerList'])->name('customerList');

    //User profiles
    Route::get('user-profile', [UserController::class, 'userProfile'])->name('userProfile');
    Route::get('logout', [UserController::class, 'logout'])->name('logout');

    Route::resource('notification', NotificationController::class);


});
