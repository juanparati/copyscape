<?php


namespace Juanparati\Copyscape\Contracts;


use GuzzleHttp\Client;


/**
 * Interface ServiceContract.
 *
 * @package Juanparati\Copyscape\Contracts
 */
interface ServiceContract
{

    /**
     * Constructor.
     *
     * @param array $config
     * @param Client $client
     */
    public function __construct(array $config, Client $client);


    /**
     * Get parsed results.
     *
     * @return mixed
     */
    public function request();
}
