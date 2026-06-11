<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout - StyleHub</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header class="header">
    <div class="container nav">
        <h1 class="logo">StyleHub</h1>

        <nav>
    <a href="/">Home</a>
    <a href="{{ route('cart.index') }}">Cart</a>

    @auth
        @if(auth()->user()->hasRole('admin'))
            <a href="{{ route('admin.products.index') }}">Admin Products</a>
            <a href="{{ route('admin.orders.index') }}">Admin Orders</a>
        @endif

        <a href="{{ route('dashboard') }}">Dashboard</a>

        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" style="background:none; border:none; color:white; font-weight:bold; cursor:pointer;">
                Logout
            </button>
        </form>
    @else
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    @endauth
</nav>
    </div>
</header>

<section class="container products">
    <h2>Checkout</h2>

    @if($errors->any())
        <div style="background:#fee2e2; padding:12px; margin-bottom:15px; border-radius:6px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="display:grid; grid-template-columns: 2fr 1fr; gap:25px;">
        <form action="{{ route('checkout.store') }}" method="POST" style="background:white; padding:25px; border-radius:10px;">
            @csrf

            <label>Full Name</label>
            <input type="text" name="name" required style="width:100%; padding:10px; margin-bottom:15px;">

            <label>Email</label>
            <input type="email" name="email" required style="width:100%; padding:10px; margin-bottom:15px;">

            <label>Phone</label>
            <input type="text" name="phone" style="width:100%; padding:10px; margin-bottom:15px;">

            <label>Address</label>
            <textarea name="address" rows="4" required style="width:100%; padding:10px; margin-bottom:15px;"></textarea>

            <label>City</label>
            <input type="text" name="city" style="width:100%; padding:10px; margin-bottom:15px;">

            <label>Country</label>
            <input type="text" name="country" style="width:100%; padding:10px; margin-bottom:15px;">

            <label>Zip Code</label>
            <input type="text" name="zip_code" style="width:100%; padding:10px; margin-bottom:15px;">

            <button type="submit" class="btn" style="border:none; cursor:pointer;">
                Place Order
            </button>
        </form>

        <div style="background:white; padding:25px; border-radius:10px;">
            <h3>Order Summary</h3>

            <br>

            @foreach($cartItems as $item)
                <p>
                    {{ $item->product->title ?? 'Deleted Product' }}
                    x {{ $item->quantity }}
                    - ${{ number_format($item->price * $item->quantity, 2) }}
                </p>
            @endforeach

            <hr style="margin:15px 0;">

            <p>Subtotal: ${{ number_format($subtotal, 2) }}</p>
            <p>Shipping: ${{ number_format($shippingPrice, 2) }}</p>

            <h3>Total: ${{ number_format($total, 2) }}</h3>

            <br>

            <p><strong>Payment Method:</strong></p>
            <p>Cash / Bank Transfer</p>

            <p><strong>Shipping Method:</strong></p>
            <p>Free Shipping</p>
        </div>
    </div>
</section>

<footer class="footer">
    <p>&copy; 2026 StyleHub. All rights reserved.</p>
</footer>

</body>
</html>