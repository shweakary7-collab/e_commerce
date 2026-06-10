@extends('frontend.layouts.master')

@section('title', 'Home')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Our Products</h1>
    
    <div class="mb-4">
        <div class="btn-group">
            @foreach($categories as $key => $catName)
                <a href="{{ route('home', ['category' => $key]) }}" 
                   class="btn btn-outline-primary {{ $category == $key ? 'active' : '' }}">
                    {{ $catName }}
                </a>
            @endforeach
        </div>
    </div>
    
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
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" style="width: 60px; display: inline-block;">
                            <button type="submit" class="btn btn-primary btn-sm">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12"><div class="alert alert-info">No products found.</div></div>
        @endforelse
    </div>
    
    <div class="d-flex justify-content-center">{{ $products->appends(['category' => $category])->links() }}</div>
</div>
@endsection