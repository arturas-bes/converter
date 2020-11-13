<?php
namespace Cart\Utils\Provider;

use Exception;

class CurrencyExchangeRates implements CurrencyExchangeProviderInterface
{

    private $rates = array(
        'USD' => 1.14,
        'EUR' => 1,
        'GBP' => 0.88
    );

    public function getRate($fromCurrency = null, $toCurrency = null)
    {
        if (!$toCurrency) {
            throw new Exception("Currency is not provided");

            return false;
        }
        if (!array_key_exists($toCurrency, $this->rates)) {
            throw new Exception("Currency not accpeted for conversion");

            return false;
        }

        return $this->rates[$toCurrency];

    }

}