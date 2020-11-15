<?php

namespace Cart\Utils;

interface FileReaderInterface
{
    /**
     * @param $file
     */
    public function read($key);

    public function getLineCount();

}