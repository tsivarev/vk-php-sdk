<?php

namespace VK\Actions;

use VK\VKAPIClient;

class Leads {
  /**
   * @var VKAPIClient
   **/
  private $client;

  public function __construct($client) {
    $this->client = $client;
  }

  /**
   * Completes the lead started by user.
   * 
   * @param $access_token string
   * @param $params array
   * vk_sid string Session obtained as GET parameter when session started.
   * secret string Secret key from the lead testing interface.
   * comment string Comment text.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function complete($access_token, $params = array()) {
    return $this->client->request('leads.complete', $access_token, $params);
  }

  /**
   * Creates new session for the user passing the offer.
   * 
   * @param $access_token string
   * @param $params array
   * lead_id integer Lead ID.
   * secret string Secret key from the lead testing interface.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function start($access_token, $params = array()) {
    return $this->client->request('leads.start', $access_token, $params);
  }

  /**
   * Returns lead stats data.
   * 
   * @param $access_token string
   * @param $params array
   * lead_id integer Lead ID.
   * secret string Secret key obtained from the lead testing interface.
   * date_start string Day to start stats from (YYYY_MM_DD, e.g.2011-09-17).
   * date_end string Day to finish stats (YYYY_MM_DD, e.g.2011-09-17).
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getStats($access_token, $params = array()) {
    return $this->client->request('leads.getStats', $access_token, $params);
  }

  /**
   * Returns a list of last user actions for the offer.
   * 
   * @param $access_token string
   * @param $params array
   * offer_id integer Offer ID.
   * secret string Secret key obtained in the lead testing interface.
   * offset integer Offset needed to return a specific subset of results.
   * count integer Number of results to return.
   * status integer Action type. Possible values: *'0' — start,, *'1' — finish,, *'2' — blocking users,, *'3' — start in a test mode,, *'4' — finish in a test mode.
   * reverse boolean Sort order. Possible values: *'1' — chronological,, *'0' — reverse chronological.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getUsers($access_token, $params = array()) {
    return $this->client->request('leads.getUsers', $access_token, $params);
  }

  /**
   * Checks if the user can start the lead.
   * 
   * @param $access_token string
   * @param $params array
   * lead_id integer Lead ID.
   * test_result integer Value to be return in 'result' field when test mode is used.
   * age integer User age.
   * country string User country code.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function checkUser($access_token, $params = array()) {
    return $this->client->request('leads.checkUser', $access_token, $params);
  }

  /**
   * Counts the metric event.
   * 
   * @param $access_token string
   * @param $params array
   * data string Metric data obtained in the lead interface.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function metricHit($access_token, $params = array()) {
    return $this->client->request('leads.metricHit', $access_token, $params);
  }
}
