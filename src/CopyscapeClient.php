<?php


namespace Juanparati\Copyscape;


use GuzzleHttp\Client;
use Juanparati\Copyscape\Contracts\ServiceContract;
use Juanparati\Copyscape\Services\BalanceService;
use Juanparati\Copyscape\Services\DelIndexService;
use Juanparati\Copyscape\Services\TextIndexService;
use Juanparati\Copyscape\Services\TextSearchService;
use Juanparati\Copyscape\Services\URLIndexService;
use Juanparati\Copyscape\Services\URLSearchService;


/**
 * Class CopyscapeClient.
 *
 * @package Juanparati\Copyscape
 */
class CopyscapeClient
{

    /**
     * HTTP Client.
     *
     * @var Client
     */
    protected $client;


    /**
     * Configuration.
     *
     * @var array
     */
    private $config = [];


    /**
     * CopyscapeClient constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;

        $this->client = new Client([
            'base_uri' => $this->config['url'],
            'timeout'  => $this->config['timeout']
        ]);
    }


    /**
     * URL search request.
     *
     * @param string $url
     * @return ServiceContract
     */
    public function searchURL(string $url) : ServiceContract
    {
        $service = new URLSearchService($this->config, $this->client);
        $service->setURL($url);

        return $service;
    }


    /**
     * Text search request.
     *
     * @param string $text
     * @param string $encoding
     * @return ServiceContract
     */
    public function searchText(string $text, string $encoding = null) : ServiceContract
    {
        $service = new TextSearchService($this->config, $this->client);
        $service->setText($text, $encoding);

        return $service;
    }


    /**
     * Get the balance.
     *
     * @return mixed
     * @throws Exceptions\ParseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getBalance()
    {
        return (new BalanceService($this->config, $this->client))->request();
    }


    /**
     * Add a private index from a URL content.
     *
     * @param string $url
     * @param string|null $id
     * @return mixed
     * @throws Exceptions\AuthException
     * @throws Exceptions\CreditsExceptions
     * @throws Exceptions\IndexException
     * @throws Exceptions\ParseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function indexURL(string $url, string $id = null)
    {
        $service = new URLIndexService($this->config, $this->client);
        $service->setURL($url);

        if ($id)
            $service->setArticleId($id);

        return $service->request();
    }


    /**
     * Add a private index from a text string.
     *
     * @param string $text
     * @param string|null $id
     * @param string $encoding
     * @return mixed
     * @throws Exceptions\AuthException
     * @throws Exceptions\CreditsExceptions
     * @throws Exceptions\IndexException
     * @throws Exceptions\ParseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function indexText(string $text, string $id = null, string $encoding = null)
    {
        $service = new TextIndexService($this->config, $this->client);
        $service->setText($text, $encoding);

        if ($id)
            $service->setArticleId($id);

        return $service->request();
    }


    /**
     * Delete a private index based on a handle.
     *
     * @param string $handle
     * @return mixed
     * @throws Exceptions\AuthException
     * @throws Exceptions\CreditsExceptions
     * @throws Exceptions\IndexException
     * @throws Exceptions\ParseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delIndex(string $handle)
    {
        $service = new DelIndexService($this->config, $this->client);
        $service->setHandle($handle);

        return $service->request();
    }

}
