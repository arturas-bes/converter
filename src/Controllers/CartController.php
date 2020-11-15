<?php

namespace Cart\Controllers;
use Cart\Classes\Cart;

class CartController
{
    private $cartItems;


    /**
     * @return mixed
     */
    public function getCartItems()
    {
        return $this->cartItems;
    }

    /**
     * @param mixed $cartItems
     */
    public function setCartItems($cartItems)
    {
        $this->cartItems = $cartItems;
    }

}