<?php

namespace VK\Actions;

use VK\VKAPIClient;

class Orders {
  /**
   * @var VKAPIClient
   **/
  private $client;

  public function __construct($client) {
    $this->client = $client;
  }

  /**
   * Returns a list of orders.
   * 
   * @param $access_token string
   * @param $params array
   * count integer number of returned orders.
   * test_mode boolean if this parameter is set to 1, this method returns a list of test mode orders. By default — 0.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function get($access_token, $params = array()) {
    return $this->client->request('orders.get', $access_token, $params);
  }

  /**
   * Returns information about orders by their IDs.
   * 
   * @param $access_token string
   * @param $params array
   * order_id integer order ID.
   * order_ids array order IDs (when information about several orders is requested).
   * test_mode boolean if this parameter is set to 1, this method returns a list of test mode orders. By default — 0.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getById($access_token, $params = array()) {
    return $this->client->request('orders.getById', $access_token, $params);
  }

  /**
   * Changes order status.
   * 
   * @param $access_token string
   * @param $params array
   * order_id integer order ID.
   * action string action to be done with the order. Available actions: *cancel — to cancel unconfirmed order. *charge — to confirm unconfirmed order. Applies only if processing of [vk.com/dev/payments_status|order_change_state] notification failed. *refund — to cancel confirmed order.
   * app_order_id integer internal ID of the order in the application.
   * test_mode boolean if this parameter is set to 1, this method returns a list of test mode orders. By default — 0.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function changeState($access_token, $params = array()) {
    return $this->client->request('orders.changeState', $access_token, $params);
  }

  /**
   * 
   * 
   * @param $access_token string
   * @param $params array
   * user_id integer
   * votes array
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getAmount($access_token, $params = array()) {
    return $this->client->request('orders.getAmount', $access_token, $params);
  }
}
