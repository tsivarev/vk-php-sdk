<?php

namespace VK\Actions;

use VK\VKAPIClient;

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
   * group_id integer Community ID.
   * app_id integer Application ID.
   * date_from string Latest datestamp (in Unix time) of statistics to return.
   * date_to string End datestamp (in Unix time) of statistics to return.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * owner_id integer post owner community id. Specify with "-" sign.
   * post_id integer wall post id. Note that stats are available only for '300' last (newest) posts on a community wall.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getPostReach($access_token, $params = array()) {
    return $this->client->request('stats.getPostReach', $access_token, $params);
  }
}
