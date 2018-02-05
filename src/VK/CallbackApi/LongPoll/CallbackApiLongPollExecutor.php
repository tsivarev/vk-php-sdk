<?php

namespace VK\CallbackApi\Longpoll;

use VK\CallbackApi\CallbackApiHandler;
use VK\Exceptions\HttpRequestException;
use VK\Exceptions\VKClientException;
use VK\CallbackApi\Longpoll\Exceptions\LongPollServerKeyExpiredException;
use VK\CallbackApi\Longpoll\Exceptions\LongPollServerTsException;
use VK\Client\VKApiClient;
use VK\Exceptions\Api\VKApiException;
use VK\TransportClient\CurlHttpClient;
use VK\TransportClient\TransportClientResponse;

class CallbackApiLongPollExecutor {
    protected const API_PARAM_GROUP_ID = 'group_id';
    protected const API_PARAM_ACT = 'act';
    protected const API_PARAM_KEY = 'key';
    protected const API_PARAM_TS = 'ts';
    protected const API_PARAM_WAIT = 'wait';
    protected const VALUE_ACT = 'a_check';

    protected const KEY_FAILED = 'failed';
    protected const KEY_TS = 'ts';
    protected const KEY_TIMESTAMP = 'timestamp';
    protected const KEY_SERVER = 'server';
    protected const KEY_KEY = 'key';
    protected const KEY_UPDATES = 'updates';
    protected const KEY_TYPE = 'type';
    protected const KEY_OBJECT = 'object';

    protected const ERROR_CODE_INCORRECT_TS_VALUE = 1;
    protected const ERROR_CODE_TOKEN_EXPIRED = 2;

    protected const CONNECTION_TIMEOUT = 10;
    protected const HTTP_STATUS_CODE_OK = 200;
    protected const DEFAULT_WAIT = 10;

    protected $api_client;
    protected $access_token;
    protected $group_id;
    protected $handler;
    protected $http_client;

    public function __construct(VKApiClient $api_client, string $access_token, int $group_id, CallbackApiHandler $handler) {
        $this->api_client = $api_client;
        $this->http_client = new CurlHttpClient(static::CONNECTION_TIMEOUT);
        $this->access_token = $access_token;
        $this->group_id = $group_id;
        $this->handler = $handler;
    }

    /**
     * Starts listening to LongPoll events.
     *
     * @throws VKApiException
     * @throws VKClientException
     * @throws LongPollServerTsException
     */
    public function run() {
        $server = $this->getLongPollServer();
        $last_ts = $server[static::KEY_TS];

        while (true) {
            try {
                $response = $this->getEvents($server[static::KEY_SERVER], $server[static::KEY_KEY], $last_ts);
                foreach ($response[static::KEY_UPDATES] as $event) {
                    $this->handler->parseObject($this->group_id, null, $event[static::KEY_TYPE], $event[static::KEY_OBJECT]);
                }
                $last_ts = $response[static::KEY_TIMESTAMP];
            } catch (LongPollServerKeyExpiredException $e) {
                $server = $this->getLongPollServer();
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

    /**
     * Retrieves events from long poll server starting from the specified timestamp.
     *
     * @param string $host
     * @param string $key
     * @param int $ts
     * @param int $wait
     *
     * @return mixed
     * @throws LongPollServerKeyExpiredException
     * @throws LongPollServerTsException
     * @throws VKClientException
     */
    public function getEvents(string $host, string $key, int $ts, int $wait = self::DEFAULT_WAIT) {
        $params = array(
            static::API_PARAM_KEY => $key,
            static::API_PARAM_TS => $ts,
            static::API_PARAM_WAIT => $wait,
            static::API_PARAM_ACT => static::VALUE_ACT
        );

        try {
            $response = $this->http_client->get($host, $params);
        } catch (HttpRequestException $e) {
            throw new VKClientException($e);
        }

        return $this->parseResponse($params, $response);
    }

    /**
     * Decodes the LongPoll response and checks its status code and whether it has a failed key.
     *
     * @param array $params
     * @param TransportClientResponse $response
     *
     * @return mixed
     *
     * @throws LongPollServerTsException
     * @throws LongPollServerKeyExpiredException
     * @throws VKClientException
     */
    private function parseResponse(array $params, TransportClientResponse $response) {
        $this->checkHttpStatus($response);

        $body = $response->getBody();
        $decode_body = $this->decodeBody($body);

        if (isset($decode_body[static::KEY_FAILED])) {
            switch ($decode_body[static::KEY_FAILED]) {
                case static::ERROR_CODE_INCORRECT_TS_VALUE:
                    $ts = $params[static::API_PARAM_TS];
                    $msg = '\'ts\' value is incorrect, minimal value is 1, maximal value is ' . $ts;
                    throw new LongPollServerTsException($msg);
                case static::ERROR_CODE_TOKEN_EXPIRED:
                    throw new LongPollServerKeyExpiredException('Try to generate a new key.');
                default:
                    throw new VKClientException('Unknown LongPollServer exception, something went wrong. ' . $decode_body);
            }
        }

        return $decode_body;
    }

    /**
     * Decodes body.
     *
     * @param string $body
     *
     * @return mixed
     */
    protected function decodeBody(string $body) {
        $decoded_body = json_decode($body, true);

        if ($decoded_body === null || !is_array($decoded_body)) {
            $decoded_body = [];
        }

        return $decoded_body;
    }

    /**
     * @param TransportClientResponse $response
     *
     * @throws VKClientException
     */
    protected function checkHttpStatus(TransportClientResponse $response) {
        if ($response->getHttpStatus() != static::HTTP_STATUS_CODE_OK) {
            throw new VKClientException('Invalid http status: ' . $response->getHttpStatus());
        }
    }
}
