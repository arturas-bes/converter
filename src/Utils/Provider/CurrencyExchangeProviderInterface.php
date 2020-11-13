<?php
namespace Cart\Utils\Provider;

interface CurrencyExchangeProviderInterface
{
    /**
     * Gets exchange rate from cache
     *
     * @param  string $fromCurrency
     * @param  string $toCurrency
     * @return float
     */
    public function getRate($fromCurrency = null, $toCurrency = null);
}