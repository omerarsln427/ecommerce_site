<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Models\Product;

Route::get('/', function () {
    $products = Product::where('status', true)->latest()->take(6)->get();

    return view('home', compact('products'));
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
});