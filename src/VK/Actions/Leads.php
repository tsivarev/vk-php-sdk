<?php

namespace VK\Actions;

use VK\VKAPIRequest;
use VK\Exceptions\VKClientException;
use VK\Exceptions\VKAPIException;
use VK\Actions\Enums\LeadsGetUsersStatus;

class Leads {

    /**
     * @var VKAPIRequest
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
     *      - string vk_sid: Session obtained as GET parameter when session started.
     *      - string secret: Secret key from the lead testing interface.
     *      - string comment: Comment text.
     * 
     * @return mixed
     * @throws VKClientException in case of error on the API side
     * @throws VKAPIException in case of network error
     * 
     **/
    public function complete($access_token, $params = array()) {
        return $this->client->post('leads.complete', $access_token, $params);
    }

    /**
     * Creates new session for the user passing the offer.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer lead_id: Lead ID.
     *      - string secret: Secret key from the lead testing interface.
     * 
     * @return mixed
     * @throws VKClientException in case of error on the API side
     * @throws VKAPIException in case of network error
     * 
     **/
    public function start($access_token, $params = array()) {
        return $this->client->post('leads.start', $access_token, $params);
    }

    /**
     * Returns lead stats data.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer lead_id: Lead ID.
     *      - string secret: Secret key obtained from the lead testing interface.
     *      - string date_start: Day to start stats from (YYYY_MM_DD, e.g.2011-09-17).
     *      - string date_end: Day to finish stats (YYYY_MM_DD, e.g.2011-09-17).
     * 
     * @return mixed
     * @throws VKClientException in case of error on the API side
     * @throws VKAPIException in case of network error
     * 
     **/
    public function getStats($access_token, $params = array()) {
        return $this->client->post('leads.getStats', $access_token, $params);
    }

    /**
     * Returns a list of last user actions for the offer.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer offer_id: Offer ID.
     *      - string secret: Secret key obtained in the lead testing interface.
     *      - integer offset: Offset needed to return a specific subset of results.
     *      - integer count: Number of results to return.
     *      - LeadsGetUsersStatus status: Action type. Possible values: *'0' — start,, *'1' — finish,, *'2' —
     *        blocking users,, *'3' — start in a test mode,, *'4' — finish in a test mode.
     *        @see LeadsGetUsersStatus
     *      - boolean reverse: Sort order. Possible values: *'1' — chronological,, *'0' — reverse
     *        chronological.
     * 
     * @return mixed
     * @throws VKClientException in case of error on the API side
     * @throws VKAPIException in case of network error
     * 
     **/
    public function getUsers($access_token, $params = array()) {
        return $this->client->post('leads.getUsers', $access_token, $params);
    }

    /**
     * Checks if the user can start the lead.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer lead_id: Lead ID.
     *      - integer test_result: Value to be return in 'result' field when test mode is used.
     *      - integer age: User age.
     *      - string country: User country code.
     * 
     * @return mixed
     * @throws VKClientException in case of error on the API side
     * @throws VKAPIException in case of network error
     * 
     **/
    public function checkUser($access_token, $params = array()) {
        return $this->client->post('leads.checkUser', $access_token, $params);
    }

    /**
     * Counts the metric event.
     * 
     * @param $access_token string
     * @param $params array
     *      - string data: Metric data obtained in the lead interface.
     * 
     * @return mixed
     * @throws VKClientException in case of error on the API side
     * @throws VKAPIException in case of network error
     * 
     **/
    public function metricHit($access_token, $params = array()) {
        return $this->client->post('leads.metricHit', $access_token, $params);
    }
}
