<?php

namespace VK\Actions;

use VK\VKAPIClient;
use VK\Exceptions\VKClientException;
use VK\VKResponse;

class Stats {
    /**
     * @var VKAPIClient
     **/
    private $client;

    public function __construct($client) {
        $this->client = $client;
    }

    /**
     * Returns statistics of a community or an application.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer group_id: Community ID.
     *      - integer app_id: Application ID.
     *      - string date_from: Latest datestamp (in Unix time) of statistics to return.
     *      - string date_to: End datestamp (in Unix time) of statistics to return.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function get($access_token, $params = array()) {
        return $this->client->request('stats.get', $access_token, $params);
    }

    /**
     * 
     * 
     * @param $access_token string
     * @param $params array
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function trackVisitor($access_token, $params = array()) {
        return $this->client->request('stats.trackVisitor', $access_token, $params);
    }

    /**
     * Returns stats for a wall post.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer owner_id: post owner community id. Specify with "-" sign.
     *      - integer post_id: wall post id. Note that stats are available only for '300' last (newest) posts on a
     *        community wall.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getPostReach($access_token, $params = array()) {
        return $this->client->request('stats.getPostReach', $access_token, $params);
    }
}
