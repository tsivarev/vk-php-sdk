<?php

namespace VK\Actions;

use VK\VKAPIRequest;
use VK\Exceptions\VKClientException;
use VK\Exceptions\VKAPIException;

class Storage {

    /**
     * @var VKAPIRequest
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
     * @return mixed
     * @throws VKClientException error on the API side
     * @throws VKAPIException network error
     * 
     **/
    public function get($access_token, $params = array()) {
        return $this->client->post('storage.get', $access_token, $params);
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
     * @return mixed
     * @throws VKClientException error on the API side
     * @throws VKAPIException network error
     * 
     **/
    public function set($access_token, $params = array()) {
        return $this->client->post('storage.set', $access_token, $params);
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
     * @return mixed
     * @throws VKClientException error on the API side
     * @throws VKAPIException network error
     * 
     **/
    public function getKeys($access_token, $params = array()) {
        return $this->client->post('storage.getKeys', $access_token, $params);
    }
}
