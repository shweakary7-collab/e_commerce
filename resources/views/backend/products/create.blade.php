@extends('backend.layouts.master')

@section('title', 'Create Product')

@section('content')
<h2>Create Product</h2>

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control" rows="5" required></textarea>
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <label>Price ($)</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label>Category</label>
            <select name="category" class="form-control" required>
                @foreach($categories as $key => $name)
                    <option value="{{ $key }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control" required>
        </div>
    </div>
    
    <div class="mb-3 mt-3">
        <label>Product Image</label>
        <input type="file" name="image" class="form-control" accept="image/*">
    </div>
    
    <div class="mb-3">
        <label>
            <input type="checkbox" name="is_active" value="1" checked> Active
        </label>
    </div>
    
    <button type="submit" class="btn btn-primary">Save Product</button>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection