<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StyleHub - Online Store</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header class="header">
    <div class="container nav">
        <h1 class="logo">StyleHub</h1>

        <nav>
            <a href="/">Home</a>
            <a href="#">Products</a>
            <a href="#">Cart</a>
            <a href="#">Login</a>
        </nav>
    </div>
</header>

<section class="hero">
    <div class="container hero-content">
        <div>
            <h2>Discover Your New Style</h2>
            <p>
                Shop modern, comfortable, and affordable products from our online store.
            </p>
            <a href="#" class="btn">Shop Now</a>
        </div>

        <div class="hero-box">
            <h3>New Season</h3>
            <p>Up to 30% off selected items</p>
        </div>
    </div>
</section>

<section class="container categories">
    <h2>Featured Categories</h2>

    <div class="category-grid">
        <div class="category-card">
            <h3>Clothing</h3>
            <p>Stylish clothes for everyday life.</p>
        </div>

        <div class="category-card">
            <h3>Shoes</h3>
            <p>Comfortable and modern shoes.</p>
        </div>

        <div class="category-card">
            <h3>Accessories</h3>
            <p>Complete your look with accessories.</p>
        </div>
    </div>
</section>

<section class="container products">
    <h2>Popular Products</h2>

    <div class="product-grid">
        <div class="product-card">
            <div class="product-image">Product Image</div>
            <h3>Classic T-Shirt</h3>
            <p>$19.99</p>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="product-image">Product Image</div>
            <h3>Sport Shoes</h3>
            <p>$49.99</p>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="product-image">Product Image</div>
            <h3>Leather Bag</h3>
            <p>$39.99</p>
            <button>Add to Cart</button>
        </div>
    </div>
</section>

<footer class="footer">
    <p>&copy; 2026 StyleHub. All rights reserved.</p>
</footer>

</body>
</html>