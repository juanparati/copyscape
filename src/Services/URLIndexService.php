<?php


namespace Juanparati\Copyscape\Services;


use Juanparati\Copyscape\Contracts\ServiceContract;


/**
 * Class URLIndexService.
 *
 * @package Juanparati\Copyscape\Services
 */
class URLIndexService extends IndexService implements ServiceContract
{

    /**
     * Default search parameters.
     *
     * @var array
     */
    protected $params =
    [
        'o'     => 'pindexadd',  // Operation
        'q'     => null,         // URL
        'f'     => 'xml',        // Response format
    ];


    /**
     * Set the URL.
     *
     * @param string $url
     * @return URLIndexService
     */
    public function setURL(string $url)
    {
        $this->params['q'] = $url;

        return $this;
    }
}
