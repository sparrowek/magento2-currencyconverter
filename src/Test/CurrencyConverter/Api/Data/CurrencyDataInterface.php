<?php
namespace Test\CurrencyConverter\Api\Data;

/**
 * Data interface for WebAPI conversion service
 */
interface CurrencyDataInterface
{
    /**
     * Return currency code
     * @return string
     */
    public function getCurrencyCode();

    /**
     * Set currency code
     * @param string $currency
     * @return void
     */
    public function setCurrencyCode($currency);

    /**
     * Return value
     * @return float
     */
    public function getValue();

    /**
     * Set value
     * @param float $value
     * @return void
     */
    public function setValue($value);
}