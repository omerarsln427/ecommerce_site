<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $product->title }} - StyleHub</title>
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

<section class="container product-detail">
    <div class="detail-card">
        <div class="detail-image">
            @if($product->image)
                <img src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->title }}">
            @else
                <div class="product-image">No Image</div>
            @endif
        </div>

        <div class="detail-info">
            <h2>{{ $product->title }}</h2>

            <p class="detail-category">
                Category: {{ $product->category->title ?? 'No Category' }}
            </p>

            <p class="detail-description">
                {{ $product->description }}
            </p>

            <p>
                {{ $product->detail }}
            </p>

            <h3>${{ $product->price }}</h3>

            <p>
                Stock: {{ $product->stock }}
            </p>

            @if($product->discount > 0)
                <p>
                    Discount: {{ $product->discount }}%
                </p>
            @endif

            <form action="{{ route('cart.add', $product->id) }}" method="POST">
    @csrf
    <button type="submit" class="cart-btn">Add to Cart</button>
</form>

            <br><br>

            <a href="/" class="btn">Back to Home</a>
        </div>
    </div>
</section>

<footer class="footer">
    <p>&copy; 2026 StyleHub. All rights reserved.</p>
</footer>

</body>
</html>