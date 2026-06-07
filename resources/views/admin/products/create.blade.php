<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Product</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header class="header">
    <div class="container nav">
        <h1 class="logo">StyleHub Admin</h1>
        <nav>
            <a href="/">Home</a>
            <a href="{{ route('admin.products.index') }}">Products</a>
        </nav>
    </div>
</header>

<section class="container products">
    <h2>Add New Product</h2>

    @if($errors->any())
        <div style="background:#fee2e2; padding:12px; margin-bottom:15px; border-radius:6px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" style="background:white; padding:25px; border-radius:10px;">
        @csrf

        <label>Category</label>
        <select name="category_id" required style="width:100%; padding:10px; margin-bottom:15px;">
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}</option>
            @endforeach
        </select>

        <label>Title</label>
        <input type="text" name="title" required style="width:100%; padding:10px; margin-bottom:15px;">

        <label>Keywords</label>
        <input type="text" name="keywords" style="width:100%; padding:10px; margin-bottom:15px;">

        <label>Description</label>
        <input type="text" name="description" style="width:100%; padding:10px; margin-bottom:15px;">

        <label>Detail</label>
        <textarea name="detail" rows="5" style="width:100%; padding:10px; margin-bottom:15px;"></textarea>

        <label>Image</label>
        <input type="file" name="image" style="width:100%; padding:10px; margin-bottom:15px;">

        <label>Price</label>
        <input type="number" step="0.01" name="price" required style="width:100%; padding:10px; margin-bottom:15px;">

        <label>Stock</label>
        <input type="number" name="stock" required style="width:100%; padding:10px; margin-bottom:15px;">

        <label>Minimum Stock</label>
        <input type="number" name="minstock" value="0" style="width:100%; padding:10px; margin-bottom:15px;">

        <label>Discount</label>
        <input type="number" name="discount" value="0" style="width:100%; padding:10px; margin-bottom:15px;">

        <label>Status</label>
        <select name="status" style="width:100%; padding:10px; margin-bottom:15px;">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>

        <button type="submit" class="btn" style="border:none; cursor:pointer;">
            Save Product
        </button>
    </form>
</section>

</body>
</html>