<?php
namespace Cart\Utils\Helpers;

class Utilities
{
    public function multiExplode($delimiters, $string)
    {
        $ready = str_replace($delimiters, $delimiters[0], $string);

        return explode($delimiters[0], $ready);
    }
}