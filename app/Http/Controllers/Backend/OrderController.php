<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        if (!auth()->user()->hasRole('admin') && !auth()->user()->can('view orders')) {
            abort(403, 'You do not have permission to view orders.');
        }
        $orders = Order::with('user')->latest()->paginate(20);
        return view('backend.orders.index', compact('orders'));
    }

    public function show($id)
    {
        if (!auth()->user()->hasRole('admin') && !auth()->user()->can('view orders')) {
            abort(403, 'You do not have permission to view orders.');
        }
        $order = Order::with('user', 'items.product')->findOrFail($id);
        return view('backend.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        if (!auth()->user()->hasRole('admin') && !auth()->user()->can('update order status')) {
            abort(403, 'You do not have permission to update order status.');
        }
        $order = Order::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);
        
        $order->update(['status' => $request->status]);
        
        return redirect()->back()->with('success', 'Order status updated!');
    }

    public function destroy($id)
    {
        if (!auth()->user()->hasRole('admin') && !auth()->user()->can('delete orders')) {
            abort(403, 'You do not have permission to delete orders.');
        }
        $order = Order::findOrFail($id);
        $order->items()->delete();
        $order->delete();
        
        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully!');
    }
}