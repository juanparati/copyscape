<?php


namespace Juanparati\Copyscape\Services;


use Juanparati\Copyscape\Exceptions\AuthException;
use Juanparati\Copyscape\Exceptions\CreditsExceptions;
use Juanparati\Copyscape\Exceptions\IndexException;
use Juanparati\Copyscape\Exceptions\ParseException;
use Juanparati\Copyscape\Services\Extensions\GenericThrowable;


/**
 * Class IndexService.
 *
 * @package Juanparati\Copyscape\Services
 */
abstract class IndexService extends Service
{

    use GenericThrowable;


    /**
     * Request method.
     *
     * @var string
     */
    protected $method = 'GET';


    /**
     * Default search parameters.
     *
     * @var array
     */
    protected $params =
    [
        'o'     => 'pindexadd',  // Operation
        'f'     => 'xml',        // Response format
    ];


    /**
     * Set the Article id.
     *
     * @param string $id
     * @return IndexService
     */
    public function setArticleId(string $id)
    {
        $this->params['i'] = $id;

        return $this;
    }


    /**
     * Get parsed results.
     *
     * @return mixed
     * @throws AuthException
     * @throws CreditsExceptions
     * @throws IndexException
     * @throws ParseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request()
    {
        $response = $this->_request([], $this->method);

        $xml = simplexml_load_string($response);

        if ($xml === false)
            throw new ParseException('Unable to decode response XML');

        // Raise response errors.
        if (isset($xml->error))
        {
            $this->raiseResponseExceptions($xml->error);
            throw new IndexException($xml->error);
        }

        return (array) $xml;
    }


}
