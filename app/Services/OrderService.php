<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use App\Repositories\CartRepository;

class OrderService
{
    protected $orderRepository;
    protected $cartRepository;

    public function __construct(OrderRepository $orderRepository, CartRepository $cartRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->cartRepository = $cartRepository;
    }

    public function createOrderFromCart($data)
    {
        $sessionId = session()->getId();
        $cartItems = $this->cartRepository->getCartItems($sessionId);
        $subtotal = $this->cartRepository->getCartSubtotal($sessionId);
        
        if ($cartItems->isEmpty()) {
            throw new \Exception('Cart is empty');
        }
        
        $order = $this->orderRepository->createOrder($data, $cartItems, $subtotal);
        $this->cartRepository->clearCart($sessionId);
        
        return $order;
    }

    public function getAllOrders()
    {
        return $this->orderRepository->getAllOrders();
    }

    public function getOrderDetails($id)
    {
        return $this->orderRepository->getOrderById($id);
    }

    public function getOrderByNumber($orderNumber)
    {
        return $this->orderRepository->getOrderByNumber($orderNumber);
    }

    public function updateOrderStatus($orderId, $status)
    {
        return $this->orderRepository->updateOrderStatus($orderId, $status);
    }

    public function deleteOrder($orderId)
    {
        return $this->orderRepository->deleteOrder($orderId);
    }

    public function getStats()
    {
        return $this->orderRepository->getOrderStats();
    }
}