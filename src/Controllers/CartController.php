<?php


class HandleCartCommand
{
    private $cartItems;

    public function __construct()
    {
        //read file
        //handle conversions
        //update cart
        //render view
    }

    public function addItem($identifier = null)
    {
        if (!$identifier) {
            return false;
        }

        return true;
    }

    public function removeItem($identifier = null)
    {
        if (!$identifier) {
            return false;
        }

        return true;
    }

    public function showCartItems($items = null)
    {
        if (!$items) {
            return false;
        }

        return $items;
    }

    public function updateCartView($cart = null)
    {
        if (!$cart) {
            return false;
        }

        return $cart;
    }
}