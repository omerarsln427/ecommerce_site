<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use App\Models\Product;

Route::get('/', function () {
    $products = Product::where('status', true)->latest()->take(6)->get();

    return view('home', compact('products'));
});

Route::get('/product/{product}', function (Product $product) {
    return view('product-detail', compact('product'));
})->name('product.detail');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/update/{cart}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{cart}', [CartController::class, 'remove'])->name('cart.remove');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
});