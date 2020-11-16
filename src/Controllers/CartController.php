<?php

namespace Cart\Controllers;
use Cart\Classes\Cart;
use Cart\InitCart;
use Cart\Utils\CurrencyConverter;
use Exception;


class CartController
{
    private $cart;

    private $currencyConverter;

    private $cartTotal;

    /**
     * @return mixed
     */
    public function getCart()
    {
        return $this->cart;
    }

    public function handleCart($id, $name, $quantity, $price, $currency): void
    {
        $this->getCurrencyConverter();


        if ($this->checkQuantity($quantity)) {
            $price = $this->currencyConverter->convert(InitCart::BASE_CURRENCY, $currency, $price);
            if ($this->add($id, $name, $quantity, $price, $currency)) {
                $this->calculateCartTotal();
            }
        } else {
            if ($this->remove($id, $name, $quantity, $price, $currency)) {
                $this->calculateCartTotal();

            }
        }
    }

    public function calculateCartTotal()
    {
        $total = null;
        if (empty($this->cart)) {
            $this->setCartTotal(0);

            return 0;
        }
        foreach ($this->cart as $item) {

            $price = $item->getPrice() * $item->getQuantity();
            $total += $price;
            $this->setCartTotal($total);
        }
    }

    /**
     * @param mixed $cartTotal
     */
    public function setCartTotal($cartTotal)
    {
        $this->cartTotal = $cartTotal;
    }

    /**
     * @return mixed
     */
    public function getCartTotal()
    {
        return $this->cartTotal;
    }

    /**
     * @param $id
     * @param $name
     * @param $quantity
     * @param $price
     * @param $currency
     */
    private function setCart($id, $name, $quantity, $price, $currency)
    {
        if ($cart = new Cart($id, $name, $quantity, $price, $currency)) {
            $this->cart[$id] = $cart;

            return true;
        }

        return false;
    }

    private function add($id, $name, $quantity, $price, $currency)
    {
        if (!$this->validateCartObj($id, $name, $quantity, $price, $currency)) {

            return false;
        }

        if ($this->isIdentifierSet($id)) {

            return false;
        }

        if (!$this->setCart($id, $name, $quantity, $price, $currency)) {
            throw new Exception("Could not add item to cart");
        } else {

            return true;
        }

    }

    public function remove($id, $name, $quantity, $price, $currency)
    {

        if (!empty($this->cart) && array_key_exists($id, $this->cart)) {

            unset($this->cart[$id]);

            return true;
        }
        return false;
    }


    private function validateCartObj($id, $name, $quantity, $price, $currency)
    {
        if (!empty($id) && !empty($name) && !empty($quantity) && !empty($price) && !empty($currency)) {

            return true;
        }

        return false;
    }

    private function isIdentifierSet($id)
    {
        if (empty($this->cart)) {

            return false;
        }

        foreach ($this->cart as $item) {
            if ($item->getId() === $id) {

                return true;
            }
        }

        return false;
    }

    private function checkQuantity($quantity)
    {
        if (!$quantity | $quantity <= 0) {

            return false;
        }

        return true;
    }

    /**
     * @return mixed
     */
    private function getCurrencyConverter()
    {
        if (!$this->currencyConverter) {
            $this->setCurrencyConverter(new CurrencyConverter());
        }

        return $this->currencyConverter;

    }

    /**
     * @param mixed $currencyConverter
     */
    private function setCurrencyConverter(CurrencyConverter $currencyConverter)
    {
        $this->currencyConverter = $currencyConverter;
    }

}