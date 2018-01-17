<?php

namespace VK\Actions;

use VK\VKAPIClient;

class Utils {
  /**
   * @var VKAPIClient
   **/
  private $client;

  public function __construct($client) {
    $this->client = $client;
  }

  /**
   * Checks whether a link is blocked in VK.
   * 
   * @param $access_token string
   * @param $params array
   * url string Link to check (e.g., 'http://google.com').
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function checkLink($access_token, $params = array()) {
    return $this->client->request('utils.checkLink', $access_token, $params);
  }

  /**
   * Deletes shortened link from user's list.
   * 
   * @param $access_token string
   * @param $params array
   * key string Link key (characters after vk.cc/).
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function deleteFromLastShortened($access_token, $params = array()) {
    return $this->client->request('utils.deleteFromLastShortened', $access_token, $params);
  }

  /**
   * Returns a list of user's shortened links.
   * 
   * @param $access_token string
   * @param $params array
   * count integer Number of links to return.
   * offset integer Offset needed to return a specific subset of links.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getLastShortenedLinks($access_token, $params = array()) {
    return $this->client->request('utils.getLastShortenedLinks', $access_token, $params);
  }

  /**
   * Returns stats data for shortened link.
   * 
   * @param $access_token string
   * @param $params array
   * key string Link key (characters after vk.cc/).
   * access_key string Access key for private link stats.
   * interval string Interval.
   * intervals_count integer Number of intervals to return.
   * extended boolean 1 — to return extended stats data (sex, age, geo). 0 — to return views number only.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getLinkStats($access_token, $params = array()) {
    return $this->client->request('utils.getLinkStats', $access_token, $params);
  }

  /**
   * Allows to receive a link shortened via vk.cc.
   * 
   * @param $access_token string
   * @param $params array
   * url string URL to be shortened.
   * private boolean 1 — private stats, 0 — public stats.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getShortLink($access_token, $params = array()) {
    return $this->client->request('utils.getShortLink', $access_token, $params);
  }

  /**
   * Detects a type of object (e.g., user, community, application) and its ID by screen name.
   * 
   * @param $access_token string
   * @param $params array
   * screen_name string Screen name of the user, community (e.g., 'apiclub,' 'andrew', or 'rules_of_war'), or application.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function resolveScreenName($access_token, $params = array()) {
    return $this->client->request('utils.resolveScreenName', $access_token, $params);
  }

  /**
   * Returns the current time of the VK server.
   * 
   * @param $access_token string
   * @param $params array
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getServerTime($access_token, $params = array()) {
    return $this->client->request('utils.getServerTime', $access_token, $params);
  }
}
