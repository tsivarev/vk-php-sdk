<?php

namespace VK\Actions;

use VK\VKAPIRequest;
use VK\Exceptions\VKClientException;
use VK\Exceptions\VKAPIException;
use VK\Exceptions\HttpRequestException;

class Widgets {

    /**
     * @var VKAPIRequest
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
     * @return array
     * @throws VKClientException
     * @throws VKAPIException
     * @throws HttpRequestException
     * 
     **/
    public function getComments($access_token, $params = array()) {
        return $this->client->post('widgets.getComments', $access_token, $params);
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
     * @return array
     * @throws VKClientException
     * @throws VKAPIException
     * @throws HttpRequestException
     * 
     **/
    public function getPages($access_token, $params = array()) {
        return $this->client->post('widgets.getPages', $access_token, $params);
    }
}
