<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Success - StyleHub</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header class="header">
    <div class="container nav">
        <h1 class="logo">StyleHub</h1>

        <nav>
            <a href="/">Home</a>
            <a href="{{ route('cart.index') }}">Cart</a>
            <a href="/admin/products">Admin Products</a>
        </nav>
    </div>
</header>

<section class="container products">
    <div style="background:white; padding:35px; border-radius:10px; text-align:center;">
        <h2>Thank You!</h2>

        <p>Your order has been placed successfully.</p>

        <br>

        <h3>Order Number: #{{ $order->id }}</h3>
        <p>Total: ${{ number_format($order->total, 2) }}</p>
        <p>Status: {{ $order->status }}</p>

        <br>

        <a href="/" class="btn">Continue Shopping</a>
    </div>
</section>

<footer class="footer">
    <p>&copy; 2026 StyleHub. All rights reserved.</p>
</footer>

</body>
</html>