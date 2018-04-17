<?php
namespace Test\CurrencyConverter\Model;

use JMS\Serializer\Annotation as JMS;

class FixerRatesModel
{
    /**
     * Base currency
     * @var string
     * @JMS\Type("string")
     */
    protected $base;

    /**
     * Date of rates
     * @var string
     * @JMS\Type("string")
     */
    protected $date;

    /**
     * Array of currency rates
     * @var array
     * @JMS\Type("array<string, float>")
     */
    protected $rates;

    /**
     * Return base currency
     * @return string
     */
    public function getBase()
    {
        return $this->base;
    }

    /**
     * Return date of currency rates
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Return currency rates
     * @return array
     */
    public function getRates()
    {
        return $this->rates;
    }
}