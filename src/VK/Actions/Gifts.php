<?php

namespace VK\Actions;

use VK\Client\VKAPIRequest;
use VK\Exceptions\VKClientException;
use VK\Exceptions\VKAPIException;

class Gifts {

    /**
     * @var VKAPIRequest
     **/
    private $request;

    public function __construct($request) {
        $this->request = $request;
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
     * @return mixed
     * @throws VKClientException in case of error on the API side
     * @throws VKAPIException in case of network error
     * 
     **/
    public function get($access_token, $params = array()) {
        return $this->request->post('gifts.get', $access_token, $params);
    }
}
