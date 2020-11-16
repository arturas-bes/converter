<?php
namespace Cart;

use Cart\Classes\Cart;
use Cart\Controllers\CartController;
use Cart\Utils\FileReader;
use Cart\Utils\FileReaderInterface;

class InitCart
{
    /**
     * Upload dir
     */
    public const FILE_DIR = 'uploads/';

    /**
     * Upload File
     */
    public const FILE = 'cart.txt';

    /**
     * Base currency
     */
    public const BASE_CURRENCY = 'EUR';

    /**
     * @var FileReaderInterface reader
     */
    private $reader;

    /**
     * @var CartController controller
     */
    private $cart;



    public function __construct()
    {
        $this->getReader();
        $this->getCartController();
        $lineCount = $this->reader->getLineCount();

        if ($lineCount) {
            for($i = 0; $i < $lineCount; $i++) {
                $item = $this->reader->read($i);
                $this->cart->handleCart($item[0], $item[1], $item[2], $item[3], $item[4], $item[5]);
               $total =  $this->cart->getCartTotal();
               print_r($total.' '.self::BASE_CURRENCY.PHP_EOL);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getReader()
    {
        $file = self::FILE_DIR.self::FILE;
        if (!$this->reader) {
            $this->setReader(new FileReader($file));
        }

        return $this->reader;
    }

    /**
     * @param FileReaderInterface $reader
     * @return $this
     */
    public function setReader(FileReaderInterface $reader)
    {
        $this->reader = $reader;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCartController()
    {
        if (!$this->cart) {
            $this->setCartController(new CartController());
        }

        return $this->cart;
    }

    /**
     * @param FileReaderInterface $cart
     * @return $this
     */
    public function setCartController(CartController $cart)
    {
        $this->cart = $cart;

        return $this;
    }
}