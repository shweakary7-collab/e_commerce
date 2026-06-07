@extends('backend.layouts.master')
@section('title', 'Dashboard')
@section('content')
<h2>Dashboard</h2>
<div class="row mt-4">
    <div class="col-md-3"><div class="card text-white bg-primary"><div class="card-body"><h5>Total Products</h5><h2>{{ $totalProducts }}</h2></div></div></div>
    <div class="col-md-3"><div class="card text-white bg-success"><div class="card-body"><h5>Total Orders</h5><h2>{{ $totalOrders }}</h2></div></div></div>
    <div class="col-md-3"><div class="card text-white bg-info"><div class="card-body"><h5>Total Revenue</h5><h2>${{ number_format($totalRevenue, 2) }}</h2></div></div></div>
    <div class="col-md-3"><div class="card text-white bg-warning"><div class="card-body"><h5>Total Users</h5><h2>{{ $totalUsers }}</h2></div></div></div>
</div>
<div class="card mt-4"><div class="card-header"><h5>Recent Orders</h5></div><div class="card-body">
    <table class="table"><thead><tr><th>Order #</th><th>User</th><th>Total</th><th>Status</th><th>Date</th></tr></thead>
    <tbody>@foreach($recentOrders as $order)<tr><td>{{ $order->order_number }}</td><td>{{ $order->user->name }}</td><td>${{ number_format($order->total_amount, 2) }}</td><td>{{ $order->status }}</td><td>{{ $order->created_at->format('Y-m-d') }}</td></tr>@endforeach</tbody>
    </table>
</div></div>
@endsection