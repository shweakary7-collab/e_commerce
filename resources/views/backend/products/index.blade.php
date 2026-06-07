@extends('backend.layouts.master')
@section('title', 'Products')
@section('content')
<div class="d-flex justify-content-between"><h2>Products</h2><a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a></div>
<table class="table table-bordered mt-3">
    <thead><tr><th>ID</th><th>Image</th><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th>Actions</th></tr></thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td><img src="{{ $product->image_url }}" width="50"></td>
            <td>{{ $product->name }}</td>
            <td>{{ ucfirst($product->category) }}</td>
            <td>${{ number_format($product->price, 2) }}</td>
            <td>{{ $product->stock }}</td>
            <td>
                <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-sm btn-info">View</a>
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button></form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $products->links() }}
@endsection