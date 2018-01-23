<?php

namespace VK\Actions;

use VK\VKAPIClient;
use VK\Exceptions\VKClientException;
use VK\VKResponse;

class Widgets {
    /**
     * @var VKAPIClient
     **/
    private $client;

    public function __construct($client) {
        $this->client = $client;
    }

    /**
     * Gets a list of comments for the page added through the [vk.com/dev/Comments|Comments widget].
     * 
     * @param $access_token string
     * @param $params array
     *      - integer widget_api_id:
     *      - string url:
     *      - string page_id:
     *      - string order:
     *      - array fields:
     *      - integer count:
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getComments($access_token, $params = array()) {
        return $this->client->request('widgets.getComments', $access_token, $params);
    }

    /**
     * Gets a list of application/site pages where the [vk.com/dev/Comments|Comments widget] or [vk.com/dev/Like|Like
     * widget] is installed.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer widget_api_id:
     *      - string order:
     *      - string period:
     *      - integer count:
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getPages($access_token, $params = array()) {
        return $this->client->request('widgets.getPages', $access_token, $params);
    }
}
