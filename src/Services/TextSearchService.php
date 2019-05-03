<?php


namespace Juanparati\Copyscape\Services;


use Juanparati\Copyscape\Contracts\ServiceContract;


/**
 * Class TextSearchService.
 *
 * Perform an URL Search.
 *
 * @see https://www.copyscape.com/api-guide.php#url
 * @package Juanparati\Copyscape\Services
 */
class TextSearchService extends SearchService implements ServiceContract
{

    /**
     * Request method.
     *
     * @var string
     */
    protected $method = 'POST';


    /**
     * Set text to be searched.
     *
     * @param string $text
     * @param string|null $encoding
     * @return TextSearchService
     */
    public function setText(string $text, string $encoding = null)
    {
        $this->params['t'] = $text;
        $this->params['e'] = $encoding ?: $this->config['encoding'];

        return $this;
    }
}
