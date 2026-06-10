<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Details - StyleHub</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header class="header">
    <div class="container nav">
        <h1 class="logo">StyleHub Admin</h1>

        <nav>
            <a href="/">Home</a>
            <a href="{{ route('admin.products.index') }}">Products</a>
            <a href="{{ route('admin.orders.index') }}">Orders</a>
        </nav>
    </div>
</header>

<section class="container products">
    <h2>Order Details #{{ $order->id }}</h2>

    @if(session('success'))
        <p style="background:#d1fae5; padding:12px; margin-bottom:15px; border-radius:6px;">
            {{ session('success') }}
        </p>
    @endif

    <div style="background:white; padding:25px; border-radius:10px; margin-bottom:25px;">
        <h3>Customer Information</h3>

        <p><strong>Name:</strong> {{ $order->name }}</p>
        <p><strong>Email:</strong> {{ $order->email }}</p>
        <p><strong>Phone:</strong> {{ $order->phone }}</p>
        <p><strong>Address:</strong> {{ $order->address }}</p>
        <p><strong>City:</strong> {{ $order->city }}</p>
        <p><strong>Country:</strong> {{ $order->country }}</p>
        <p><strong>Zip Code:</strong> {{ $order->zip_code }}</p>
    </div>

    <div style="background:white; padding:25px; border-radius:10px; margin-bottom:25px;">
        <h3>Order Status</h3>

        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
            @csrf
            @method('PUT')

            <select name="status" style="padding:10px; margin-right:10px;">
                @foreach(\App\Models\Order::STATUSES as $status)
                    <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn" style="border:none; cursor:pointer;">
                Update Status
            </button>
        </form>
    </div>

    <div style="background:white; padding:25px; border-radius:10px;">
        <h3>Order Items</h3>

        <table style="width:100%; margin-top:20px; border-collapse:collapse;">
            <thead>
                <tr style="background:#111827; color:white;">
                    <th style="padding:12px;">Product</th>
                    <th style="padding:12px;">Price</th>
                    <th style="padding:12px;">Quantity</th>
                    <th style="padding:12px;">Total</th>
                </tr>
            </thead>

            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td style="padding:12px;">{{ $item->product_title }}</td>
                        <td style="padding:12px; text-align:center;">${{ number_format($item->price, 2) }}</td>
                        <td style="padding:12px; text-align:center;">{{ $item->quantity }}</td>
                        <td style="padding:12px; text-align:center;">${{ number_format($item->total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="text-align:right; margin-top:25px;">
            <p>Subtotal: ${{ number_format($order->subtotal, 2) }}</p>
            <p>Shipping: ${{ number_format($order->shipping_price, 2) }}</p>
            <h3>Total: ${{ number_format($order->total, 2) }}</h3>
        </div>

        <br>

        <a href="{{ route('admin.orders.index') }}" class="btn">Back to Orders</a>
    </div>
</section>

<footer class="footer">
    <p>&copy; 2026 StyleHub. All rights reserved.</p>
</footer>

</body>
</html>