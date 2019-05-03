<?php


namespace Juanparati\Copyscape\Services;


use Juanparati\Copyscape\Contracts\ServiceContract;
use Juanparati\Copyscape\Exceptions\ParseException;


/**
 * Class BalanceService.
 *
 * @package Juanparati\Copyscape\Services
 */
class BalanceService extends Service implements ServiceContract
{


    /**
     * Default search parameters.
     *
     * @var array
     */
    protected $params =
    [
        'o'     => 'balance',    // Search type
        'f'     => 'xml',        // Response format
    ];


    /**
     * Get parsed results.
     *
     * @return mixed
     * @throws ParseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request()
    {
        $response = $this->_request();

        $xml = simplexml_load_string($response);

        if ($xml === false)
            throw new ParseException('Unable to decode response XML');

        return (array) $xml;
    }
}
