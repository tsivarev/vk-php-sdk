<?php

namespace VK\Actions;

use VK\VKAPIRequest;
use VK\Exceptions\VKClientException;
use VK\Exceptions\VKAPIException;
use VK\Exceptions\HttpRequestException;

class Streaming {

    /**
     * @var VKAPIRequest
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
     * @return array
     * @throws VKClientException
     * @throws VKAPIException
     * @throws HttpRequestException
     * 
     **/
    public function getServerUrl($access_token, $params = array()) {
        return $this->client->post('streaming.getServerUrl', $access_token, $params);
    }
}
