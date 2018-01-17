<?php

namespace VK\Actions;

use VK\VKAPIClient;

class Search {
  /**
   * @var VKAPIClient
   **/
  private $client;

  public function __construct($client) {
    $this->client = $client;
  }

  /**
   * Allows the programmer to do a quick search for any substring.
   * 
   * @param $access_token string
   * @param $params array
   * q string Search query string.
   * offset integer Offset for querying specific result subset
   * limit integer Maximum number of results to return.
   * filters array 
   * search_global boolean 
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getHints($access_token, $params = array()) {
    return $this->client->request('search.getHints', $access_token, $params);
  }
}
