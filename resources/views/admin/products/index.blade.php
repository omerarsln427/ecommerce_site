<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Products</title>
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
    <h2>Product List</h2>

    @if(session('success'))
        <p style="background:#d1fae5; padding:12px; margin-bottom:15px; border-radius:6px;">
            {{ session('success') }}
        </p>
    @endif

    <a href="{{ route('admin.products.create') }}" class="btn">Add New Product</a>

    <table style="width:100%; margin-top:25px; background:white; border-collapse:collapse;">
        <thead>
            <tr style="background:#111827; color:white;">
                <th style="padding:12px;">ID</th>
                <th style="padding:12px;">Image</th>
                <th style="padding:12px;">Title</th>
                <th style="padding:12px;">Category</th>
                <th style="padding:12px;">Price</th>
                <th style="padding:12px;">Stock</th>
                <th style="padding:12px;">Status</th>
                <th style="padding:12px;">Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse($products as $product)
                <tr>
                    <td style="padding:12px; text-align:center;">{{ $product->id }}</td>

                    <td style="padding:12px; text-align:center;">
                        @if($product->image)
                            <img src="{{ asset('uploads/products/' . $product->image) }}" width="70">
                        @else
                            No Image
                        @endif
                    </td>

                    <td style="padding:12px;">{{ $product->title }}</td>
                    <td style="padding:12px;">{{ $product->category->title ?? 'No Category' }}</td>
                    <td style="padding:12px;">${{ $product->price }}</td>
                    <td style="padding:12px;">{{ $product->stock }}</td>
                    <td style="padding:12px;">{{ $product->status ? 'Active' : 'Inactive' }}</td>

                    <td style="padding:12px;">
                        <a href="{{ route('admin.products.show', $product->id) }}">Show</a> |
                        <a href="{{ route('admin.products.edit', $product->id) }}">Edit</a> |

                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="padding:20px; text-align:center;">
                        No products found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</section>

</body>
</html>