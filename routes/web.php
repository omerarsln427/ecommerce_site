<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Models\Product;

Route::get('/', function () {
    $products = Product::where('status', true)->latest()->take(6)->get();

    return view('home', compact('products'));
});

Route::get('/product/{product}', function (Product $product) {
    return view('product-detail', compact('product'));
})->name('product.detail');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
});