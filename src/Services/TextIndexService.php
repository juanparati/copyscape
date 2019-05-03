<?php


namespace Juanparati\Copyscape\Services;


use Juanparati\Copyscape\Contracts\ServiceContract;


/**
 * Class TextIndexService.
 *
 * @package Juanparati\Copyscape\Services
 */
class TextIndexService extends IndexService implements ServiceContract
{

    /**
     * Request method.
     *
     * @var string
     */
    protected $method = 'POST';


    /**
     * Default search parameters.
     *
     * @var array
     */
    protected $params =
    [
        'o'     => 'pindexadd',  // Operation
        'e'     => 'UTF-8',      // Encoding
        't'     => null,         // Text to index
        'f'     => 'xml',        // Response format
    ];


    /**
     * Set text to be searched.
     *
     * @param string $text
     * @param string|null $encoding
     * @return TextIndexService
     */
    public function setText(string $text, string $encoding = null)
    {
        $this->params['t'] = $text;
        $this->params['e'] = $encoding ?: $this->config['encoding'];

        return $this;
    }
}
