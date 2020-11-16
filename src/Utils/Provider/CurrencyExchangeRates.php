<?php
namespace Cart\Utils\Provider;

use Exception;

class CurrencyExchangeRates implements CurrencyExchangeProviderInterface
{

    //TODO implement logic if base currency is not constant
    /**
     * @var array
     */
    private $rates = array(
        'USD' => 1.14,
        'EUR' => 1,
        'GBP' => 0.88
    );

    /**
     * @param null $fromCurrency
     * @param null $toCurrency
     * @return false|float|mixed
     * @throws Exception
     */
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