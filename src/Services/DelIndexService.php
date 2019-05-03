<?php


namespace Juanparati\Copyscape\Services;


use Juanparati\Copyscape\Contracts\ServiceContract;


/**
 * Class DelIndexService.
 *
 * @package Juanparati\Copyscape\Services
 */
class DelIndexService extends IndexService implements ServiceContract
{

    /**
     * Default search parameters.
     *
     * @var array
     */
    protected $params =
    [
        'o'     => 'pindexdel',  // Operation
        'h'     => null,         // Article handle
        'f'     => 'xml',        // Response format
    ];


    /**
     * Set the URL.
     *
     * @param string $handle
     * @return DelIndexService
     */
    public function setHandle(string $handle)
    {
        $this->params['h'] = $handle;

        return $this;
    }
}
