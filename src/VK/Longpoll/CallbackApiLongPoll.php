<?php

namespace VK\Longpoll;

use VK\Exceptions\VKClientException;
use VK\Longpoll\Exceptions\LongPollServerKeyExpiredException;
use VK\Longpoll\Exceptions\LongPollServerTsException;
use VK\Client\VKApiClient;
use VK\Exceptions\VKApiException;

class CallbackApiLongPoll extends CallbackApi {
    protected const API_PARAM_GROUP_ID = 'group_id';

    protected const TS_KEY = 'ts';
    protected const TIMESTAMP_KEY = 'timestamp';
    protected const SERVER_KEY = 'server';
    protected const KEY_KEY = 'key';
    protected const UPDATES_KEY = 'updates';

    protected $api_client;
    protected $access_token;
    protected $group_id;

    public function __construct($access_token, $group_id) {
        $this->api_client = new VKApiClient();
        $this->access_token = $access_token;
        $this->group_id = $group_id;
    }

    /**
     * Starts listening to LongPoll events.
     *
     * @throws VKApiException
     * @throws VKClientException
     * @throws LongPollServerTsException
     */
    public function run() {
        $longpoll_server = $this->getLongPollServer();
        $last_ts = $longpoll_server[static::TS_KEY];

        $longpoll_request = new LongpollRequest();

        while (true) {
            try {
                $longpoll_events_response = $longpoll_request->getEvents($longpoll_server[static::SERVER_KEY],
                    $longpoll_server[static::KEY_KEY], $last_ts);
                foreach ($longpoll_events_response[static::UPDATES_KEY] as $event) {
                    $this->parse($event);
                }
                $last_ts = $longpoll_events_response[static::TIMESTAMP_KEY];
            } catch (LongPollServerKeyExpiredException $e) {
                $longpoll_server = $this->getLongPollServer();
            }
        }
    }

    /**
     * @return mixed
     * @throws VKApiException
     * @throws VKClientException
     */
    protected function getLongPollServer() {
        $params = array(
            static::API_PARAM_GROUP_ID => $this->group_id
        );
        return $this->api_client->groups()->getLongPollServer($this->access_token, $params);
    }
}
