@extends('backend.layouts.master')
@section('title', 'Edit Product')
@section('content')
<h2>Edit Product</h2>
<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="mb-3"><label>Name</label><input type="text" name="name" class="form-control" value="{{ $product->name }}" required></div>
    <div class="mb-3"><label>Description</label><textarea name="description" class="form-control" rows="5" required>{{ $product->description }}</textarea></div>
    <div class="row">
        <div class="col-md-4"><label>Price ($)</label><input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price }}" required></div>
        <div class="col-md-4"><label>Category</label><select name="category" class="form-control" required>@foreach($categories as $key=>$name)<option value="{{ $key }}" {{ $product->category==$key?'selected':'' }}>{{ $name }}</option>@endforeach</select></div>
        <div class="col-md-4"><label>Stock</label><input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required></div>
    </div>
    <div class="mb-3 mt-3">
        @if($product->image)<img src="{{ $product->image_url }}" width="100" class="mb-2"><br>@endif
        <label>New Image</label><input type="file" name="image" class="form-control">
    </div>
    <div class="mb-3"><label><input type="checkbox" name="is_active" value="1" {{ $product->is_active?'checked':'' }}> Active</label></div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection