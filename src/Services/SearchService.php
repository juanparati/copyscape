<?php


namespace Juanparati\Copyscape\Services;


use Juanparati\Copyscape\Contracts\ServiceContract;
use Juanparati\Copyscape\Exceptions\AuthException;
use Juanparati\Copyscape\Exceptions\CreditsExceptions;
use Juanparati\Copyscape\Exceptions\ParseException;
use Juanparati\Copyscape\Exceptions\SearchException;
use Juanparati\Copyscape\Services\Extensions\GenericThrowable;


/**
 * Class SearchService.
 *
 * @see https://www.copyscape.com/api-guide.php
 * @package Juanparati\Copyscape\Services
 */
abstract class SearchService extends Service implements ServiceContract
{

    use GenericThrowable;


    /**
     * Search types
     */
    const SEARCH_TYPE_PUBLIC  = 'csearch';  // Search against the public internet
    const SEARCH_TYPE_PRIVATE = 'psearch';  // Search against the private index
    const SEARCH_TYPE_BOTH    = 'cpsearch'; // Search against the public internet and the private index


    /**
     * Default search parameters.
     *
     * @var array
     */
    protected $params =
    [
        'o'     => self::SEARCH_TYPE_PUBLIC,    // Search type
        'c'     => 0,                           // Full comparison
        'f'     => 'xml',                       // Response format
        'i'     => [],                          // Ignore sites
        'l'     => 0.1,                         // Spend limit
        'x'     => 0                            // Example test
    ];


    /**
     * Request method.
     *
     * @var string
     */
    protected $method = 'GET';


    /**
     * List of ignored sites.
     *
     * @var array
     */
    protected $ignored_sites = [];


    /**
     * Set the search type.
     *
     * @param string $search_type
     * @return SearchService
     */
    public function setSearchType(string $search_type = self::SEARCH_TYPE_PUBLIC)
    {
        $this->params['o'] = $search_type;

        return $this;
    }


    /**
     * Set full comparison.
     *
     * @param int $full_comparison
     * @return SearchService
     * @throws \Exception
     */
    public function setFullComparison(int $full_comparison = 10)
    {
        if ($full_comparison < 0 || $full_comparison > 10)
            throw new \Exception('Full comparison bounds are between 0 and 10');

        $this->params['c'] = $full_comparison;

        return $this;
    }


    /**
     * Set ignore sites.
     *
     * @param array $sites
     * @return SearchService
     */
    public function setIgnoreSites($sites = [])
    {
        $this->ignored_sites = array_combine($sites, $sites);

        return $this;
    }


    /**
     * Append new sites to the ignore sites list.
     *
     * @param mixed ...$sites
     * @return SearchService
     */
    public function addIgnoreSite(...$sites)
    {
        foreach ($sites as $site)
            $this->ignored_sites[$site] = $site;

        return $this;
    }


    /**
     * Delete specific sites from the ignore sites list.
     *
     * @param mixed ...$sites
     * @return SearchService
     */
    public function delIgnoreSite(...$sites)
    {
        foreach ($sites as $site)
            unset($this->ignored_sites[$site]);

        return $this;
    }


    /**
     * Set spend limit.
     *
     * @param float $spend
     * @return SearchService
     */
    public function setSpendLimit(float $spend)
    {
        $this->params['l'] = $spend;

        return $this;
    }


    /**
     * Test mode.
     *
     * @param bool $test_mode
     * @return SearchService
     */
    public function setTestMode(bool $test_mode = true)
    {
        $this->params['x'] = $test_mode;

        return $this;
    }


    /**
     * Get request result.
     *
     * @return array
     * @throws AuthException
     * @throws CreditsExceptions
     * @throws ParseException
     * @throws SearchException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Juanparati\Copyscape\Exceptions\IndexException
     */
    public function request()
    {
        // Set ignored sites as extra parameter
        $response = $this->_request(['i' => implode(',', $this->ignored_sites)], $this->method);

        $xml = simplexml_load_string($response);

        if ($xml === false)
            throw new ParseException('Unable to decode response XML');

        // Raise response errors.
        if (isset($xml->error))
        {
            $this->raiseResponseExceptions($xml->error);
            throw new SearchException($xml->error);
        }

        return  json_decode(json_encode((array) $xml),true);
    }
}
