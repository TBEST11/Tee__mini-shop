<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware(['auth'])->group(function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('payment', PaymentController::class);
    Route::resource('order', OrderController::class);
    Route::resource('order_item', OrderItemController::class);
    Route::resource('address', AddressController::class);
});

Route::resource('about',AboutController::class);
Route::resource('subscription',SubscriptionController::class);
Route::resource('contact',ContactController::class);
Route::resource('product', ProductController::class);