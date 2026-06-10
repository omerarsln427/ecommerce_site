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
            <a href="/admin/products">Admin Products</a>
            <a href="#">Cart</a>
            <a href="#">Login</a>
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

            <button class="cart-btn">Add to Cart</button>

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