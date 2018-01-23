<?php

namespace VK\Actions;

use VK\VKAPIClient;
use VK\Exceptions\VKClientException;
use VK\VKResponse;

class Streaming {
    /**
     * @var VKAPIClient
     **/
    private $client;

    public function __construct($client) {
        $this->client = $client;
    }

    /**
     * Allows to receive data for the connection to Streaming API.
     * 
     * @param $access_token string
     * @param $params array
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getServerUrl($access_token, $params = array()) {
        return $this->client->request('streaming.getServerUrl', $access_token, $params);
    }
}
