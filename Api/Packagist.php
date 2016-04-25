<?php

namespace Bacon\Bundle\PackagistBundle\Api;

use GuzzleHttp\Client;

/**
 * Class Packagist
 *
 * @package Bacon\Bundle\PackagistBundle\Api
 *
 * @author Adan Felipe Medeiros <adan.grg@gmail.com>
 * @version 1.0
 */
class Packagist
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $endpoint;

    /**
     * @var string
     */
    private $methodRequest;

    /**
     * @var array
     */
    private $parametersRequest  = [];

    /**
     * Packagist constructor.
     *
     * @param $baseUrlApi
     */
    public function __construct($baseUrlApi)
    {
        $this->client = new Client(['base_uri' => $baseUrlApi]);
    }

    /**
     * @param $endpoint
     * @param $method
     * @return $this
     */
    public function api($endpoint, $method)
    {
        $this->endpoint = $endpoint;
        $this->methodRequest = $method;

        return $this;
    }

    /**
     * @param array $parameters
     * @return $this
     */
    public function setParameters(array $parameters)
    {
        $this->parametersRequest = $parameters;
        return $this;
    }

    /**
     * @return string
     */
    public function getResponse()
    {
        $urlRequest = $this->endpoint;

        if (!empty($this->parametersRequest))
            $urlRequest .= '?' . http_build_query($this->parametersRequest);

        $request = $this->client->request($this->methodRequest, $urlRequest);

        $bodyResponse = $request->getBody()->getContents();

        if ($request->getHeaderLine('Content-Type') === 'application/json') {
            return json_decode($bodyResponse, true);
        }

        return $bodyResponse;
    }
}
