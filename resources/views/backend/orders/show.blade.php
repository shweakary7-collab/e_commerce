@extends('backend.layouts.master')
@section('title', 'Order Details')
@section('content')
<h2>Order Details: {{ $order->order_number }}</h2>
<div class="row">
    <div class="col-md-6">
        <div class="card"><div class="card-header">Customer</div><div class="card-body">
            <p><strong>Name:</strong> {{ $order->user->name }}</p>
            <p><strong>Email:</strong> {{ $order->user->email }}</p>
            <p><strong>Address:</strong> {{ $order->shipping_address ?? 'N/A' }}</p>
        </div></div>
    </div>
    <div class="col-md-6">
        <div class="card"><div class="card-header">Order Info</div><div class="card-body">
            <p><strong>Date:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
            <p><strong>Status:</strong> {{ $order->status }}</p>
            <p><strong>Payment:</strong> {{ $order->payment_method ?? 'N/A' }}</p>
        </div></div>
    </div>
</div>
<div class="card mt-3">
    <div class="card-header">Items</div>
    <div class="card-body">
        <table class="table">
            <thead><tr><th>Product</th><th>Quantity</th><th>Price</th><th>Subtotal</th></tr></thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td>${{ number_format($item->quantity * $item->price, 2) }}</td>
                </tr>
                @endforeach
                <tr class="table-active"><th colspan="3" class="text-end">Total:</th><th>${{ number_format($order->total_amount, 2) }}</th></tr>
            </tbody>
        </table>
    </div>
</div>
<a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mt-3">Back</a>
@endsection