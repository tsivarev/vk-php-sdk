<?php

namespace VK\Actions;

use VK\VKAPIClient;

class Storage {
  /**
   * @var VKAPIClient
   **/
  private $client;

  public function __construct($client) {
    $this->client = $client;
  }

  /**
   * Returns a value of variable with the name set by key parameter.
   * 
   * @param $access_token string
   * @param $params array
   * key string
   * keys array
   * user_id integer
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function get($access_token, $params = array()) {
    return $this->client->request('storage.get', $access_token, $params);
  }

  /**
   * Saves a value of variable with the name set by 'key' parameter.
   * 
   * @param $access_token string
   * @param $params array
   * key string
   * value string
   * user_id integer
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function set($access_token, $params = array()) {
    return $this->client->request('storage.set', $access_token, $params);
  }

  /**
   * Returns the names of all variables.
   * 
   * @param $access_token string
   * @param $params array
   * user_id integer user id, whose variables names are returned if they were requested with a server method.
   * count integer amount of variable names the info needs to be collected from.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getKeys($access_token, $params = array()) {
    return $this->client->request('storage.getKeys', $access_token, $params);
  }
}
