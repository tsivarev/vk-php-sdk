<?php

namespace VK\Actions;

use VK\VKAPIClient;
use VK\Exceptions\VKClientException;
use VK\VKResponse;

class Storage {
    /**
     * @var VKAPIClient
     **/
    private $client;

    public function __construct($client) {
        $this->client = $client;
    }

    /**
     * Returns a value of variable with the name set by key parameter.
     * 
     * @param $access_token string
     * @param $params array
     *      - string key:
     *      - array keys:
     *      - integer user_id:
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function get($access_token, $params = array()) {
        return $this->client->request('storage.get', $access_token, $params);
    }

    /**
     * Saves a value of variable with the name set by 'key' parameter.
     * 
     * @param $access_token string
     * @param $params array
     *      - string key:
     *      - string value:
     *      - integer user_id:
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function set($access_token, $params = array()) {
        return $this->client->request('storage.set', $access_token, $params);
    }

    /**
     * Returns the names of all variables.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer user_id: user id, whose variables names are returned if they were requested with a server
     *        method.
     *      - integer count: amount of variable names the info needs to be collected from.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getKeys($access_token, $params = array()) {
        return $this->client->request('storage.getKeys', $access_token, $params);
    }
}
