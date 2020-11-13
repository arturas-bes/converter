<?php
namespace Cart;

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
        $file = self::FILE_DIR.self::FILE;
        $this->reader->read($file);

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
        if (!$this->reader) {
            $this->setReader(new FileReader());
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