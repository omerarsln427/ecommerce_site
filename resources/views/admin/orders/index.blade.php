<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Orders - StyleHub</title>
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
    <h2>Order List</h2>

    @if($orders->count() > 0)
        <table style="width:100%; margin-top:25px; background:white; border-collapse:collapse;">
            <thead>
                <tr style="background:#111827; color:white;">
                    <th style="padding:12px;">Order ID</th>
                    <th style="padding:12px;">Customer</th>
                    <th style="padding:12px;">Email</th>
                    <th style="padding:12px;">Total</th>
                    <th style="padding:12px;">Status</th>
                    <th style="padding:12px;">Date</th>
                    <th style="padding:12px;">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td style="padding:12px; text-align:center;">#{{ $order->id }}</td>
                        <td style="padding:12px;">{{ $order->name }}</td>
                        <td style="padding:12px;">{{ $order->email }}</td>
                        <td style="padding:12px; text-align:center;">${{ number_format($order->total, 2) }}</td>
                        <td style="padding:12px; text-align:center;">{{ $order->status }}</td>
                        <td style="padding:12px; text-align:center;">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                        <td style="padding:12px; text-align:center;">
                            <a href="{{ route('admin.orders.show', $order->id) }}">Show Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div style="background:white; padding:25px; margin-top:25px; border-radius:10px;">
            <p>No orders found.</p>
        </div>
    @endif
</section>

<footer class="footer">
    <p>&copy; 2026 StyleHub. All rights reserved.</p>
</footer>

</body>
</html>