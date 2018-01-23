<?php

namespace VK\Actions;

use VK\VKAPIClient;
use VK\Exceptions\VKClientException;
use VK\VKResponse;

class Status {
    /**
     * @var VKAPIClient
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
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function get($access_token, $params = array()) {
        return $this->client->request('status.get', $access_token, $params);
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
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function set($access_token, $params = array()) {
        return $this->client->request('status.set', $access_token, $params);
    }
}
