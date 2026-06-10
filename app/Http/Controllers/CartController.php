<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $userId = Auth::id() ?? 1;

        $cartItems = Cart::with('product')
            ->where('user_id', $userId)
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Product $product)
    {
        $userId = Auth::id() ?? 1;

        $cartItem = Cart::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $cartItem->quantity + 1,
            ]);
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully.');
    }

    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart->update([
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    }

    public function remove(Cart $cart)
    {
        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Product removed from cart.');
    }
}