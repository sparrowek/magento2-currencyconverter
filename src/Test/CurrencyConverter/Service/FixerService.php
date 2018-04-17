<?php
namespace Test\CurrencyConverter\Service;

use Test\CurrencyConverter\Api\CurrencyConverterServiceInterface;
use Test\CurrencyConverter\Api\Data\CurrencyDataInterface;
use Test\CurrencyConverter\Model\Data\CurrencyModel;
use Test\CurrencyConverter\Model\FixerRatesModel;

/**
 * Fixer.io currrency converter implementation
 */
class FixerService implements CurrencyConverterServiceInterface
{
    /**
     * HTTP client
     * @var \GuzzleHttp\ClientInterface
     */
    protected $httpClient;

    /**
     * @var \JMS\Serializer\SerializerBuilder
     */
    protected $serializer;

    /**
     * @param \GuzzleHttp\ClientInterface $httpClient
     */
    public function __construct(
        \GuzzleHttp\ClientInterface $httpClient,
        \JMS\Serializer\SerializerBuilder $serializer
    )
    {
        $this->httpClient = $httpClient;
        $this->serializer = $serializer;
    }

    /**
     * Ask fixer.io for currency rates
     * @param CurrencyDataInterface $currency base currency
     * @return FixerRatesModel rates
     * @throws CurrencyConversionException
     */
    private function fetchCurrencyRates(CurrencyDataInterface $currency)
    {
        //use guzzle to fetch data
        $response = $this->httpClient->request('GET', '?base=' . $currency->getCurrencyCode());
        $body = $response->getBody()->getContents();

        //deserialize response JSON to model
        /** @var $data \Test\CurrencyConverter\Model\FixerRatesModel */
        $data = $this->serializer->build()->deserialize($body, 'Test\CurrencyConverter\Model\FixerRatesModel', 'json');

        //error handling
        if (is_null($data) || !is_object($data)) {
            throw new CurrencyConversionException('Error during fetching rates from Fixer.io!');
        }
        //check if response matches currency we asked for
        if (empty($data->getBase()) || $data->getBase() != $currency->getCurrencyCode()) {
            throw new CurrencyConversionException('Error during fetching rates from Fixer.io!');
        }

        return $data;
    }

    /**
     * Converts from base currency to another
     * @param CurrencyDataInterface $inputCurrency input currency
     * @param string $outputCurrencyCode output currency code
     * @return CurrencyDataInterface output currency
     * @throws CurrencyConversionException in case of conversion errors
     */
    public function convertCurrency(CurrencyDataInterface $inputCurrency, $outputCurrencyCode)
    {
        //validate input
        if (empty($inputCurrency->getCurrencyCode())) {
            throw new CurrencyConversionException('Input currency code not supplied!');
        }
        if (strlen($inputCurrency->getCurrencyCode()) != 3) {
            throw new CurrencyConversionException('Incorrect currency code!');
        }
        if (!is_numeric($inputCurrency->getValue())) {
            throw new CurrencyConversionException('Incorrect input currency!');
        }

        //fetch currency rates
        $rates = $this->fetchCurrencyRates($inputCurrency)->getRates();

        //check if rate exists for our currency
        if (!is_array($rates)) {
            throw new CurrencyConversionException('No rates for given currency!');
        }
        if (!isset($rates[$outputCurrencyCode])) {
            throw new CurrencyConversionException('No rates for given currency!');
        }

        //caluculate output value
        $conversionRate = $rates[$outputCurrencyCode];
        $inputValue = $inputCurrency->getValue();
        $outputValue = $inputValue * $conversionRate;

        $outputCurrency = new CurrencyModel();
        $outputCurrency->setCurrencyCode($outputCurrencyCode);
        $outputCurrency->setValue($outputValue);

        return $outputCurrency;
    }
}