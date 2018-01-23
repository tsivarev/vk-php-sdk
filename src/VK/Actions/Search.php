<?php

namespace VK\Actions;

use VK\VKAPIClient;
use VK\Exceptions\VKClientException;
use VK\VKResponse;

class Search {
    /**
     * @var VKAPIClient
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
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getHints($access_token, $params = array()) {
        return $this->client->request('search.getHints', $access_token, $params);
    }
}
