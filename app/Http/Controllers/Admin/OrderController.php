<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items');

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:New,Accepted,Cancelled,Onshipping,Completed',
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.orders.show', $order->id)
            ->with('success', 'Order status updated successfully.');
    }
}