<?php

namespace VK\Actions;

use VK\VKAPIClient;
use VK\Exceptions\VKClientException;
use VK\VKResponse;
use VK\Actions\Enums\OrdersChangeStateAction;

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
     *      - integer count: number of returned orders.
     *      - boolean test_mode: if this parameter is set to 1, this method returns a list of test mode orders. By
     *        default — 0.
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer order_id: order ID.
     *      - array order_ids: order IDs (when information about several orders is requested).
     *      - boolean test_mode: if this parameter is set to 1, this method returns a list of test mode orders. By
     *        default — 0.
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer order_id: order ID.
     *      - OrdersChangeStateAction action: action to be done with the order. Available actions: *cancel — to
     *        cancel unconfirmed order. *charge — to confirm unconfirmed order. Applies only if processing of
     *        [vk.com/dev/payments_status|order_change_state] notification failed. *refund — to cancel confirmed order.
     *        @see OrdersChangeStateAction
     *      - integer app_order_id: internal ID of the order in the application.
     *      - boolean test_mode: if this parameter is set to 1, this method returns a list of test mode orders. By
     *        default — 0.
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer user_id:
     *      - array votes:
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getAmount($access_token, $params = array()) {
        return $this->client->request('orders.getAmount', $access_token, $params);
    }
}
