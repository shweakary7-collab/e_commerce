<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;

class OrderRepository
{
    public function createOrder($data, $cartItems, $subtotal)
    {
        $orderNumber = 'ORD-' . strtoupper(Str::random(10));
        
        $order = Order::create([
            'order_number' => $orderNumber,
            'user_id' => auth()->id(),
            'user_name' => $data['name'],
            'user_email' => $data['email'],
            'user_phone' => $data['phone'] ?? null,
            'shipping_address' => $data['address'] ?? null,
            'subtotal' => $subtotal,
            'total' => $subtotal,
            'payment_method' => $data['payment_method'],
            'payment_status' => 'pending',
            'order_status' => 'pending',
            'notes' => $data['notes'] ?? null,
        ]);
        
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_name' => $item->product_name,
                'product_image' => $item->product_image,
                'product_price' => $item->product_price,
                'quantity' => $item->quantity,
                'subtotal' => $item->product_price * $item->quantity
            ]);
        }
        
        return $order;
    }

    public function getAllOrders()
    {
        return Order::with('user', 'items')->latest()->get();
    }

    public function getOrderById($id)
    {
        return Order::with('user', 'items')->findOrFail($id);
    }

    public function getOrderByNumber($orderNumber)
    {
        return Order::with('items')->where('order_number', $orderNumber)->firstOrFail();
    }

    public function updateOrderStatus($orderId, $status)
    {
        $order = Order::findOrFail($orderId);
        $order->order_status = $status;
        $order->save();
        return $order;
    }

    public function deleteOrder($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->items()->delete();
        $order->delete();
        return true;
    }

    public function getOrderStats()
    {
        return [
            'total' => Order::count(),
            'pending' => Order::where('order_status', 'pending')->count(),
            'processing' => Order::where('order_status', 'processing')->count(),
            'delivered' => Order::where('order_status', 'delivered')->count(),
        ];
    }
}