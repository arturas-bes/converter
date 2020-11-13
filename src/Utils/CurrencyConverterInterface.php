<?php
namespace Cart\Utils;

interface CurrencyConverterInterface
{
    /**
     * @param $from
     * @param $to
     * @param int $amount
     * @return mixed
     */
    public function convert($from, $to, $amount = 1);
}