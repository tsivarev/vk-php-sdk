<?php

namespace VK\Actions;

use VK\VKAPIRequest;
use VK\Exceptions\VKClientException;
use VK\Exceptions\VKAPIException;

class Streaming {

    /**
     * @var VKAPIRequest
     **/
    private $request;

    public function __construct($request) {
        $this->request = $request;
    }

    /**
     * Allows to receive data for the connection to Streaming API.
     * 
     * @param $access_token string
     * @param $params array
     * 
     * @return mixed
     * @throws VKClientException in case of error on the API side
     * @throws VKAPIException in case of network error
     * 
     **/
    public function getServerUrl($access_token, $params = array()) {
        return $this->request->post('streaming.getServerUrl', $access_token, $params);
    }
}
