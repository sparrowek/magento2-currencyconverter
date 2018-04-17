<?php
namespace Test\CurrencyConverter\Api;

use Test\CurrencyConverter\Api\Data\CurrencyDataInterface;

/**
 * Interface for WebAPI conversion service
 */
interface CurrencyConverterServiceInterface
{
    /**
     * Converts from base currency to another
     *
     * @param \Test\CurrencyConverter\Api\Data\CurrencyDataInterface $inputCurrency input currency
     * @param string $outputCurrencyCode output currency code
     * @return \Test\CurrencyConverter\Api\Data\CurrencyDataInterface output currency
     */
    public function convertCurrency(CurrencyDataInterface $inputCurrency, $outputCurrencyCode);
}