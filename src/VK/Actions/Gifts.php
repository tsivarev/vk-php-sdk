<?php

namespace VK\Actions;

use VK\VKAPIClient;

class Gifts {
  /**
   * @var VKAPIClient
   **/
  private $client;

  public function __construct($client) {
    $this->client = $client;
  }

  /**
   * Returns a list of user gifts.
   * 
   * @param $access_token string
   * @param $params array
   * user_id integer User ID.
   * count integer Number of gifts to return.
   * offset integer Offset needed to return a specific subset of results.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function get($access_token, $params = array()) {
    return $this->client->request('gifts.get', $access_token, $params);
  }
}
