<?php


namespace Juanparati\Copyscape\Services;


use Juanparati\Copyscape\Contracts\ServiceContract;


/**
 * Class URLSearchService.
 *
 * Perform an URL Search.
 *
 * @see https://www.copyscape.com/api-guide.php#url
 * @package Juanparati\Copyscape\Services
 */
class URLSearchService extends SearchService implements ServiceContract
{
    /**
     * Set the source URL.
     *
     * @param string $url
     * @return URLSearchService
     */
    public function setURL(string $url)
    {
        $this->params['q'] = $url;

        return $this;
    }
}
