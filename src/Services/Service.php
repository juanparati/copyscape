<?php


namespace Juanparati\Copyscape\Services;


use GuzzleHttp\Client;


/**
 * Class Service.
 *
 * @package Juanparati\Copyscape\Services
 */
abstract class Service
{

    /**
     * Default search parameters.
     *
     * @var array
     */
    protected $params = [];


    /**
     * Configuration.
     *
     * @var array
     */
    protected $config = [];


    /**
     * HTTP Client.
     *
     * @var Client
     */
    protected $client;


    /**
     * Service constructor.
     *
     * @param array $config
     * @param Client $client
     */
    public function __construct(array $config, Client $client)
    {
        $this->config = $config;
        $this->client = $client;
    }


    /**
     * Perform HTTP/s request.
     *
     * @param array $extra_params
     * @param string $method
     * @return \Psr\Http\Message\StreamInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function _request(array $extra_params = [], string $method = 'GET')
    {
        // Add credentials
        $params = array_merge($this->params, $extra_params);
        $params['u'] = $this->config['username'];
        $params['k'] = $this->config['key'];

        $param_key = $method === 'GET' ? 'query' : 'form_params';

        $response = $this->client->request($method, $this->config['url'], [$param_key => $params]);

        return $response->getBody();
    }

}
