@extends('backend.layouts.master')

@section('title', 'Orders')

@section('content')
<h2>All Orders</h2>

<div class="table-responsive mt-3">
    <table class="table table-bordered">
        <thead>
            <tr><th>ID</th><th>Order #</th><th>Customer</th><th>Total</th><th>Status</th><th>Date</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->order_number }}</td>
                <td>{{ $order->user->name }}</td>
                <td>${{ number_format($order->total_amount, 2) }}</td>
                <td>
                    <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="d-flex">
                        @csrf
                        <select name="status" class="form-select form-select-sm" style="width: 120px;">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-primary ms-2">Update</button>
                    </form>
                </td>
                <td>{{ $order->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info">View</a>
                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this order?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $orders->links() }}
</div>
@endsection