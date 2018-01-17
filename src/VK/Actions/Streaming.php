<?php

namespace VK\Actions;

use VK\VKAPIClient;

class Streaming {
  /**
   * @var VKAPIClient
   **/
  private $client;

  public function __construct($client) {
    $this->client = $client;
  }

  /**
   * Allows to receive data for the connection to Streaming API.
   * 
   * @param $access_token string
   * @param $params array
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getServerUrl($access_token, $params = array()) {
    return $this->client->request('streaming.getServerUrl', $access_token, $params);
  }
}
