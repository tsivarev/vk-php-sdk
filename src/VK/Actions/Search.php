<?php

namespace VK\Actions;

use VK\VKAPIRequest;
use VK\Exceptions\VKClientException;
use VK\Exceptions\VKAPIException;

class Search {

    /**
     * @var VKAPIRequest
     **/
    private $client;

    public function __construct($client) {
        $this->client = $client;
    }

    /**
     * Allows the programmer to do a quick search for any substring.
     * 
     * @param $access_token string
     * @param $params array
     *      - string q: Search query string.
     *      - integer offset: Offset for querying specific result subset
     *      - integer limit: Maximum number of results to return.
     *      - array filters: 
     *      - boolean search_global: 
     * 
     * @return mixed
     * @throws VKClientException in case of error on the API side
     * @throws VKAPIException in case of network error
     * 
     **/
    public function getHints($access_token, $params = array()) {
        return $this->client->post('search.getHints', $access_token, $params);
    }
}
