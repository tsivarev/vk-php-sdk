<?php

namespace VK\Actions;

use VK\VKAPIRequest;
use VK\Exceptions\VKClientException;
use VK\Exceptions\VKAPIException;

class Status {

    /**
     * @var VKAPIRequest
     **/
    private $request;

    public function __construct($request) {
        $this->request = $request;
    }

    /**
     * Returns data required to show the status of a user or community.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer user_id: User ID or community ID. Use a negative value to designate a community ID.
     *      - integer group_id:
     * 
     * @return mixed
     * @throws VKClientException in case of error on the API side
     * @throws VKAPIException in case of network error
     * 
     **/
    public function get($access_token, $params = array()) {
        return $this->request->post('status.get', $access_token, $params);
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
     * @return mixed
     * @throws VKClientException in case of error on the API side
     * @throws VKAPIException in case of network error
     * 
     **/
    public function set($access_token, $params = array()) {
        return $this->request->post('status.set', $access_token, $params);
    }
}
