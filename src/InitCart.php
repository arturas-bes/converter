<?php
namespace Cart;

use Cart\Classes\Cart;
use Cart\Utils\FileReader;
use Cart\Utils\FileReaderInterface;

class InitCart
{
    const FILE_DIR = 'uploads/';

    const FILE = 'cart.txt';

    private $reader;

    private $cart;

    public function __construct()
    {
        $this->getReader();
        $lineCount = $this->reader->getLineCount();

        if ($lineCount) {
            for($i = 0; $i < $lineCount; $i++) {
                $this->reader->read($i);
                $item = $this->reader->read($i);
                $cart[] = new Cart($item[0], $item[1], $item[2], $item[3], $item[4], $item[5]);
            }
            var_dump($cart);

        }



        //getLine
        //handle cart item logix
        //output to console
        //loop

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
}