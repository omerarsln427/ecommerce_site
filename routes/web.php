<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Models\Product;
use App\Http\Controllers\Admin\OrderController;

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

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});