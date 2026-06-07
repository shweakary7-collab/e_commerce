@extends('frontend.layouts.master')

@section('title', 'Cart')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Shopping Cart</h1>
    
    @if($cartItems->isEmpty())
        <div class="alert alert-info">Your cart is empty. <a href="{{ route('home') }}">Continue shopping</a></div>
    @else
        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered">
                    <thead><tr><th>Product</th><th>Price</th><th>Quantity</th><th>Subtotal</th><th>Action</th></tr></thead>
                    <tbody>
                        @foreach($cartItems as $item)
                        <tr>
                            <td><img src="{{ $item->product->image_url }}" width="50"> {{ $item->product->name }}</td>
                            <td>${{ number_format($item->product->price, 2) }}</td>
                            <td>
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex">
                                    @csrf @method('PUT')
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" style="width:70px;" class="form-control">
                                    <button type="submit" class="btn btn-sm btn-secondary ms-2">Update</button>
                                </form>
                            </td>
                            <td>${{ number_format($item->quantity * $item->product->price, 2) }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"><h5>Cart Summary</h5></div>
                    <div class="card-body">
                        <p><strong>Total: ${{ number_format($total, 2) }}</strong></p>
                        <a href="{{ route('checkout.index') }}" class="btn btn-success w-100">Proceed to Checkout</a>
                        <a href="{{ route('home') }}" class="btn btn-secondary w-100 mt-2">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection