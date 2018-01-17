<?php

namespace VK\Actions;

use VK\VKAPIClient;

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
   * widget_api_id integer
   * url string
   * page_id string
   * order string
   * fields array
   * count integer
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getComments($access_token, $params = array()) {
    return $this->client->request('widgets.getComments', $access_token, $params);
  }

  /**
   * Gets a list of application/site pages where the [vk.com/dev/Comments|Comments widget] or [vk.com/dev/Like|Like widget] is installed.
   * 
   * @param $access_token string
   * @param $params array
   * widget_api_id integer
   * order string
   * period string
   * count integer
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getPages($access_token, $params = array()) {
    return $this->client->request('widgets.getPages', $access_token, $params);
  }
}
