<?php
namespace Cart\Utils;

interface FileReaderInterface
{
    /**
     * @param $key
     */
    public function read($key);
}