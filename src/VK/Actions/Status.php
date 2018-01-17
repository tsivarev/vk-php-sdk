<?php

namespace VK\Actions;

use VK\VKAPIClient;

class Status {
  /**
   * @var VKAPIClient
   **/
  private $client;

  public function __construct($client) {
    $this->client = $client;
  }

  /**
   * Returns data required to show the status of a user or community.
   * 
   * @param $access_token string
   * @param $params array
   * user_id integer User ID or community ID. Use a negative value to designate a community ID.
   * group_id integer
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function get($access_token, $params = array()) {
    return $this->client->request('status.get', $access_token, $params);
  }

  /**
   * Sets a new status for the current user.
   * 
   * @param $access_token string
   * @param $params array
   * text string Text of the new status.
   * group_id integer Identifier of a community to set a status in. If left blank the status is set to current user.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function set($access_token, $params = array()) {
    return $this->client->request('status.set', $access_token, $params);
  }
}
