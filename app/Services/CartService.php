<?php

namespace App\Services;

use App\Repositories\CartRepository;
use Illuminate\Support\Facades\Session;

class CartService
{
    protected $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function getSessionId()
    {
        return Session::getId();
    }

    public function getCartItems()
    {
        return $this->cartRepository->getCartItems($this->getSessionId());
    }

    public function getSubtotal()
    {
        return $this->cartRepository->getCartSubtotal($this->getSessionId());
    }

    public function addItem($productId, $quantity = 1)
    {
        return $this->cartRepository->addToCart($this->getSessionId(), $productId, $quantity);
    }

    public function updateItem($cartId, $quantity)
    {
        return $this->cartRepository->updateCartItem($cartId, $quantity);
    }

    public function removeItem($cartId)
    {
        return $this->cartRepository->removeCartItem($cartId);
    }

    public function clearCart()
    {
        return $this->cartRepository->clearCart($this->getSessionId());
    }
}