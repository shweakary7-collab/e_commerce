@extends('frontend.layouts.master')

@section('title', 'Checkout')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Checkout</h1>
    
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h5>Shipping Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->name ?? '' }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ Auth::user()->email ?? '' }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Shipping Address</label>
                            <textarea name="shipping_address" class="form-control" rows="3" required placeholder="Enter your shipping address"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>
                            <select class="form-control" disabled>
                                <option>Cash on Delivery</option>
                            </select>
                            <small class="text-muted">Demo mode - Cash on Delivery only</small>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Place Order</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h5>Order Summary</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        @foreach($cartItems as $item)
                            <tr>
                                <td>{{ $item->product->name }} x {{ $item->quantity }}</td>
                                <td class="text-end">${{ number_format($item->quantity * $item->product->price, 2) }}</td>
                            </tr>
                        @endforeach
                        <tr class="border-top">
                            <th>Total:</th>
                            <th class="text-end">${{ number_format($total, 2) }}</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection