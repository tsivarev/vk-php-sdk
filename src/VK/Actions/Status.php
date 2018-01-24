<?php

namespace VK\Actions;

use VK\VKAPIRequest;
use VK\Exceptions\VKClientException;
use VK\Exceptions\VKAPIException;
use VK\Exceptions\HttpRequestException;

class Status {

    /**
     * @var VKAPIRequest
     **/
    private $client;

    public function __construct($client) {
        $this->client = $client;
    }

    /**
     * Returns data required to show the status of a user or community.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer user_id: User ID or community ID. Use a negative value to designate a community ID.
     *      - integer group_id:
     * 
     * @return array
     * @throws VKClientException
     * @throws VKAPIException
     * @throws HttpRequestException
     * 
     **/
    public function get($access_token, $params = array()) {
        return $this->client->post('status.get', $access_token, $params);
    }

    /**
     * Sets a new status for the current user.
     * 
     * @param $access_token string
     * @param $params array
     *      - string text: Text of the new status.
     *      - integer group_id: Identifier of a community to set a status in. If left blank the status is set to
     *        current user.
     * 
     * @return array
     * @throws VKClientException
     * @throws VKAPIException
     * @throws HttpRequestException
     * 
     **/
    public function set($access_token, $params = array()) {
        return $this->client->post('status.set', $access_token, $params);
    }
}
