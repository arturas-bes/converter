<?php
namespace Cart\Utils\Helpers;

class Utilities
{
    public function multiExplode($delimeters, $string)
    {
        $ready = str_replace($delimeters, $delimeters[0], $string);
        $result = explode($delimeters[0], $ready);

        return  $result;
    }
}