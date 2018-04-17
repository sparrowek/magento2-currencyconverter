<?php
namespace Test\CurrencyConverter\Model\Data;

use Test\CurrencyConverter\Api\Data\CurrencyDataInterface;

/**
 * Model of currency
 */
class CurrencyModel implements CurrencyDataInterface
{
    /**
     * Currency code
     * @var string
     */
    protected $currencyCode;

    /**
     * Value
     * @var float
     */
    protected $value;

    /**
     * {@inheritDoc}
     * @see \Test\CurrencyConverter\Api\Data\CurrencyDataInterface::getCurrencyCode()
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * {@inheritDoc}
     * @see \Test\CurrencyConverter\Api\Data\CurrencyDataInterface::setCurrencyCode()
     */
    public function setCurrencyCode($currency)
    {
        $this->currencyCode = $currency;
    }

    /**
     * {@inheritDoc}
     * @see \Test\CurrencyConverter\Api\Data\CurrencyDataInterface::getValue()
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritDoc}
     * @see \Test\CurrencyConverter\Api\Data\CurrencyDataInterface::setValue()
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}