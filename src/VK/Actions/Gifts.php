<?php

namespace VK\Actions;

use VK\VKAPIRequest;
use VK\Exceptions\VKClientException;
use VK\Exceptions\VKAPIException;
use VK\Exceptions\HttpRequestException;

class Gifts {

    /**
     * @var VKAPIRequest
     **/
    private $client;

    public function __construct($client) {
        $this->client = $client;
    }

    /**
     * Returns a list of user gifts.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer user_id: User ID.
     *      - integer count: Number of gifts to return.
     *      - integer offset: Offset needed to return a specific subset of results.
     * 
     * @return array
     * @throws VKClientException
     * @throws VKAPIException
     * @throws HttpRequestException
     * 
     **/
    public function get($access_token, $params = array()) {
        return $this->client->post('gifts.get', $access_token, $params);
    }
}
