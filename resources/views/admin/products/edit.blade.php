<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
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
    <a href="{{ route('admin.orders.index') }}">Orders</a>

    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" style="background:none; border:none; color:white; font-weight:bold; cursor:pointer; margin-left:20px; font-size:16px;">
    Logout
</button>
    </form>
</nav>
    </div>
</header>

<section class="container products">
    <h2>Edit Product</h2>

    @if($errors->any())
        <div style="background:#fee2e2; padding:12px; margin-bottom:15px; border-radius:6px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" style="background:white; padding:25px; border-radius:10px;">
        @csrf
        @method('PUT')

        <label>Category</label>
        <select name="category_id" required style="width:100%; padding:10px; margin-bottom:15px;">
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->title }}
                </option>
            @endforeach
        </select>

        <label>Title</label>
        <input type="text" name="title" value="{{ $product->title }}" required style="width:100%; padding:10px; margin-bottom:15px;">

        <label>Keywords</label>
        <input type="text" name="keywords" value="{{ $product->keywords }}" style="width:100%; padding:10px; margin-bottom:15px;">

        <label>Description</label>
        <input type="text" name="description" value="{{ $product->description }}" style="width:100%; padding:10px; margin-bottom:15px;">

        <label>Detail</label>
        <textarea name="detail" rows="5" style="width:100%; padding:10px; margin-bottom:15px;">{{ $product->detail }}</textarea>

        <label>Current Image</label><br>
        @if($product->image)
            <img src="{{ asset('uploads/products/' . $product->image) }}" width="120" style="margin:10px 0;">
        @else
            <p>No Image</p>
        @endif

        <br>

        <label>New Image</label>
        <input type="file" name="image" style="width:100%; padding:10px; margin-bottom:15px;">

        <label>Price</label>
        <input type="number" step="0.01" name="price" value="{{ $product->price }}" required style="width:100%; padding:10px; margin-bottom:15px;">

        <label>Stock</label>
        <input type="number" name="stock" value="{{ $product->stock }}" required style="width:100%; padding:10px; margin-bottom:15px;">

        <label>Minimum Stock</label>
        <input type="number" name="minstock" value="{{ $product->minstock }}" style="width:100%; padding:10px; margin-bottom:15px;">

        <label>Discount</label>
        <input type="number" name="discount" value="{{ $product->discount }}" style="width:100%; padding:10px; margin-bottom:15px;">

        <label>Status</label>
        <select name="status" style="width:100%; padding:10px; margin-bottom:15px;">
            <option value="1" {{ $product->status ? 'selected' : '' }}>Active</option>
            <option value="0" {{ !$product->status ? 'selected' : '' }}>Inactive</option>
        </select>

        <button type="submit" class="btn" style="border:none; cursor:pointer;">
            Update Product
        </button>
    </form>
</section>

</body>
</html>