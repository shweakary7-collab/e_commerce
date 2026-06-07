@extends('backend.layouts.master')
@section('title', 'View Product')
@section('content')
<h2>{{ $product->name }}</h2>
<div class="row">
    <div class="col-md-4"><img src="{{ $product->image_url }}" class="img-fluid"></div>
    <div class="col-md-8">
        <table class="table">
            <tr><th>Price:</th><td>${{ number_format($product->price, 2) }}</td></tr>
            <tr><th>Category:</th><td>{{ ucfirst($product->category) }}</td></tr>
            <tr><th>Stock:</th><td>{{ $product->stock }}</td></tr>
            <tr><th>Status:</th><td>{{ $product->is_active?'Active':'Inactive' }}</td></tr>
            <tr><th>Description:</th><td>{{ $product->description }}</td></tr>
        </table>
    </div>
</div>
<a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back</a>
@endsection