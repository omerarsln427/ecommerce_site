<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart - StyleHub</title>
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
    <h2>Shopping Cart</h2>

    @if(session('success'))
        <p style="background:#d1fae5; padding:12px; margin-bottom:15px; border-radius:6px;">
            {{ session('success') }}
        </p>
    @endif

    @if($cartItems->count() > 0)
        <table style="width:100%; margin-top:25px; background:white; border-collapse:collapse;">
            <thead>
                <tr style="background:#111827; color:white;">
                    <th style="padding:12px;">Product</th>
                    <th style="padding:12px;">Price</th>
                    <th style="padding:12px;">Quantity</th>
                    <th style="padding:12px;">Subtotal</th>
                    <th style="padding:12px;">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td style="padding:12px;">
                            {{ $item->product->title ?? 'Deleted Product' }}
                        </td>

                        <td style="padding:12px; text-align:center;">
                            ${{ $item->price }}
                        </td>

                        <td style="padding:12px; text-align:center;">
                            <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" style="width:70px; padding:6px;">

                                <button type="submit">
                                    Update
                                </button>
                            </form>
                        </td>

                        <td style="padding:12px; text-align:center;">
                            ${{ number_format($item->price * $item->quantity, 2) }}
                        </td>

                        <td style="padding:12px; text-align:center;">
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" onclick="return confirm('Remove this product from cart?')">
                                    Remove
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="background:white; padding:25px; margin-top:25px; border-radius:10px; text-align:right;">
            <h3>Total: ${{ number_format($total, 2) }}</h3>

            <br>

            <a href="/" class="btn">Continue Shopping</a>
            <a href="{{ route('checkout.index') }}" class="btn">Checkout</a>
        </div>
    @else
        <div style="background:white; padding:25px; margin-top:25px; border-radius:10px;">
            <p>Your cart is empty.</p>
            <br>
            <a href="/" class="btn">Start Shopping</a>
        </div>
    @endif
</section>

<footer class="footer">
    <p>&copy; 2026 StyleHub. All rights reserved.</p>
</footer>

</body>
</html>