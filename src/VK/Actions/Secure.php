<?php

namespace VK\Actions;

use VK\VKAPIClient;

class Secure {
  /**
   * @var VKAPIClient
   **/
  private $client;

  public function __construct($client) {
    $this->client = $client;
  }

  /**
   * Returns payment balance of the application in hundredth of a vote.
   * 
   * @param $access_token string
   * @param $params array
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getAppBalance($access_token, $params = array()) {
    return $this->client->request('secure.getAppBalance', $access_token, $params);
  }

  /**
   * Shows history of votes transaction between users and the application.
   * 
   * @param $access_token string
   * @param $params array
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getTransactionsHistory($access_token, $params = array()) {
    return $this->client->request('secure.getTransactionsHistory', $access_token, $params);
  }

  /**
   * Shows a list of SMS notifications sent by the application using [vk.com/dev/secure.sendSMSNotification|secure.sendSMSNotification] method.
   * 
   * @param $access_token string
   * @param $params array
   * user_id integer
   * date_from integer filter by start date. It is set as UNIX-time.
   * date_to integer filter by end date. It is set as UNIX-time.
   * limit integer number of returned posts. By default — 1000.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getSMSHistory($access_token, $params = array()) {
    return $this->client->request('secure.getSMSHistory', $access_token, $params);
  }

  /**
   * Sends 'SMS' notification to a user's mobile device.
   * 
   * @param $access_token string
   * @param $params array
   * user_id integer ID of the user to whom SMS notification is sent. The user shall allow the application to send him/her notifications (, +1).
   * message string 'SMS' text to be sent in 'UTF-8' encoding. Only Latin letters and numbers are allowed. Maximum size is '160' characters.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function sendSMSNotification($access_token, $params = array()) {
    return $this->client->request('secure.sendSMSNotification', $access_token, $params);
  }

  /**
   * Sends notification to the user.
   * 
   * @param $access_token string
   * @param $params array
   * user_ids array
   * user_id integer
   * message string notification text which should be sent in 'UTF-8' encoding ('254' characters maximum).
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function sendNotification($access_token, $params = array()) {
    return $this->client->request('secure.sendNotification', $access_token, $params);
  }

  /**
   * Sets a counter which is shown to the user in bold in the left menu.
   * 
   * @param $access_token string
   * @param $params array
   * counters array
   * user_id integer
   * counter integer counter value.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function setCounter($access_token, $params = array()) {
    return $this->client->request('secure.setCounter', $access_token, $params);
  }

  /**
   * Sets user game level in the application which can be seen by his/her friends.
   * 
   * @param $access_token string
   * @param $params array
   * levels array
   * user_id integer
   * level integer level value.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function setUserLevel($access_token, $params = array()) {
    return $this->client->request('secure.setUserLevel', $access_token, $params);
  }

  /**
   * Returns one of the previously set game levels of one or more users in the application.
   * 
   * @param $access_token string
   * @param $params array
   * user_ids array
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getUserLevel($access_token, $params = array()) {
    return $this->client->request('secure.getUserLevel', $access_token, $params);
  }

  /**
   * Adds user activity information to an application
   * 
   * @param $access_token string
   * @param $params array
   * user_id integer ID of a user to save the data
   * activity_id integer there are 2 default activities: , * 1 – level. Works similar to ,, * 2 – points, saves points amount, Any other value is for saving completed missions
   * value integer depends on activity_id: * 1 – number, current level number,, * 2 – number, current user's points amount, , Any other value is ignored
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function addAppEvent($access_token, $params = array()) {
    return $this->client->request('secure.addAppEvent', $access_token, $params);
  }

  /**
   * Checks the user authentication in 'IFrame' and 'Flash' apps using the 'access_token' parameter.
   * 
   * @param $access_token string
   * @param $params array
   * token string client 'access_token'
   * ip string user 'ip address'. Note that user may access using the 'ipv6' address, in this case it is required to transmit the 'ipv6' address. If not transmitted, the address will not be checked.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function checkToken($access_token, $params = array()) {
    return $this->client->request('secure.checkToken', $access_token, $params);
  }
}
