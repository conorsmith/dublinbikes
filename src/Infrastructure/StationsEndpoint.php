<?php

namespace ConorSmith\Dublinbikes\Infrastructure;

use GuzzleHttp\Client;

class StationsEndpoint
{
    private $apiKey;
    private $httpService;

    public function __construct($apiKey, Client $httpService)
    {
        $this->apiKey = $apiKey;
        $this->httpService = $httpService;
    }

    public function get()
    {
        $request = $this->httpService->createRequest('GET', 'https://api.jcdecaux.com/vls/v1/stations');

        $query = $request->getQuery();
        $query->set('contract', 'dublin');
        $query->set('apiKey', $this->apiKey);

        $response = $this->httpService->send($request);

        if ($response->getStatusCode() != 200) {
            throw new \RuntimeException("Couldn't connect to stations endpoint. Response " . $response->getStatusCode() . " " . $response->getReasonPhrase());
        }

        return $response->json();
    }
}
