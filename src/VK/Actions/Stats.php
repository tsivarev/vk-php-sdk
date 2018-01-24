<?php

namespace VK\Actions;

use VK\VKAPIRequest;
use VK\Exceptions\VKClientException;
use VK\Exceptions\VKAPIException;

class Stats {

    /**
     * @var VKAPIRequest
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
     * @return mixed
     * @throws VKClientException in case of error on the API side
     * @throws VKAPIException in case of network error
     * 
     **/
    public function get($access_token, $params = array()) {
        return $this->client->post('stats.get', $access_token, $params);
    }

    /**
     * 
     * 
     * @param $access_token string
     * @param $params array
     * 
     * @return mixed
     * @throws VKClientException in case of error on the API side
     * @throws VKAPIException in case of network error
     * 
     **/
    public function trackVisitor($access_token, $params = array()) {
        return $this->client->post('stats.trackVisitor', $access_token, $params);
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
     * @return mixed
     * @throws VKClientException in case of error on the API side
     * @throws VKAPIException in case of network error
     * 
     **/
    public function getPostReach($access_token, $params = array()) {
        return $this->client->post('stats.getPostReach', $access_token, $params);
    }
}
