@extends('frontend.layouts.master')

@section('title', ucfirst($currentCategory) . ' - Products')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">{{ ucfirst($currentCategory) }} Products</h1>
    
    <!-- Categories Navigation -->
    <div class="mb-4">
        <div class="btn-group flex-wrap">
            <a href="{{ route('home') }}" class="btn btn-outline-primary">
                All Products
            </a>
            @foreach($categories as $key => $catName)
                @if($key !== 'all')
                    <a href="{{ route('category.show', $key) }}" 
                       class="btn btn-outline-primary {{ $currentCategory == $key ? 'active' : '' }}">
                        {{ $catName }}
                    </a>
                @endif
            @endforeach
        </div>
    </div>
    
    <!-- Products Grid -->
    <div class="row">
        @forelse($products as $product)
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card product-card h-100">
                    <img src="{{ $product->image_url }}" class="card-img-top product-image" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($product->description, 100) }}</p>
                        <p class="card-text">
                            <strong class="text-primary">${{ number_format($product->price, 2) }}</strong>
                            <small class="text-muted"> | Stock: {{ $product->stock }}</small>
                        </p>
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="input-group">
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control form-control-sm" style="width: 70px;">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-cart-plus"></i> Add
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> No products found in this category.
                </div>
            </div>
        @endforelse
    </div>
    
    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection