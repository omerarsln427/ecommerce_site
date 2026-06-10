<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $userId = Auth::id() ?? 1;

        $cartItems = Cart::with('product')
            ->where('user_id', $userId)
            ->get();

        if ($cartItems->count() == 0) {
            return redirect()->route('cart.index')->with('success', 'Your cart is empty.');
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $shippingPrice = 0;
        $total = $subtotal + $shippingPrice;

        return view('checkout.index', compact('cartItems', 'subtotal', 'shippingPrice', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:30',
            'address' => 'required|string',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:20',
        ]);

        $userId = Auth::id() ?? 1;

        $cartItems = Cart::with('product')
            ->where('user_id', $userId)
            ->get();

        if ($cartItems->count() == 0) {
            return redirect()->route('cart.index')->with('success', 'Your cart is empty.');
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $shippingPrice = 0;
        $total = $subtotal + $shippingPrice;

        $order = Order::create([
            'user_id' => $userId,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'zip_code' => $request->zip_code,
            'subtotal' => $subtotal,
            'shipping_price' => $shippingPrice,
            'total' => $total,
            'shipping_method' => 'Free Shipping',
            'payment_method' => 'Cash / Bank Transfer',
            'status' => 'New',
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_title' => $item->product->title ?? 'Deleted Product',
                'price' => $item->price,
                'quantity' => $item->quantity,
                'total' => $item->price * $item->quantity,
            ]);
        }

        Cart::where('user_id', $userId)->delete();

        return redirect()->route('checkout.success', $order->id);
    }

    public function success(Order $order)
    {
        return view('checkout.success', compact('order'));
    }
}