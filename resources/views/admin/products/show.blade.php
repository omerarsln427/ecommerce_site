<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Details</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header class="header">
    <div class="container nav">
        <h1 class="logo">StyleHub Admin</h1>
        <nav>
            <a href="/">Home</a>
            <a href="{{ route('admin.products.index') }}">Products</a>
            <a href="{{ route('admin.products.create') }}">Add Product</a>
        </nav>
    </div>
</header>

<section class="container products">
    <h2>Product Details</h2>

    <div style="background:white; padding:25px; border-radius:10px;">
        @if($product->image)
            <img src="{{ asset('uploads/products/' . $product->image) }}" width="180" style="margin-bottom:20px;">
        @endif

        <p><strong>ID:</strong> {{ $product->id }}</p>
        <p><strong>Title:</strong> {{ $product->title }}</p>
        <p><strong>Category:</strong> {{ $product->category->title ?? 'No Category' }}</p>
        <p><strong>Keywords:</strong> {{ $product->keywords }}</p>
        <p><strong>Description:</strong> {{ $product->description }}</p>
        <p><strong>Detail:</strong> {{ $product->detail }}</p>
        <p><strong>Price:</strong> ${{ $product->price }}</p>
        <p><strong>Stock:</strong> {{ $product->stock }}</p>
        <p><strong>Minimum Stock:</strong> {{ $product->minstock }}</p>
        <p><strong>Discount:</strong> {{ $product->discount }}%</p>
        <p><strong>Status:</strong> {{ $product->status ? 'Active' : 'Inactive' }}</p>

        <br>

        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn">Edit Product</a>
        <a href="{{ route('admin.products.index') }}" class="btn">Back to Products</a>
    </div>
</section>

</body>
</html>