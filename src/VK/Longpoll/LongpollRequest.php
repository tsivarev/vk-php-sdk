<?php

namespace VK\Longpoll;

use VK\Client\VKClientBase;
use VK\Exceptions\HttpRequestException;
use VK\Exceptions\VKClientException;
use VK\Longpoll\Exceptions\LongPollServerKeyExpiredException;
use VK\Longpoll\Exceptions\LongPollServerTsException;
use VK\TransportClient\CurlHttpClient;
use VK\TransportClient\TransportClientResponse;

class LongpollRequest extends VKClientBase {
    protected const API_PARAM_ACT = 'act';
    protected const API_PARAM_KEY = 'key';
    protected const API_PARAM_TS = 'ts';
    protected const API_PARAM_WAIT = 'wait';
    protected const VALUE_ACT = 'a_check';

    protected const FAILED_KEY = 'failed';

    protected const INCORRECT_TS_VALUE_ERROR_CODE = 1;
    protected const TOKEN_EXPIRED_ERROR_CODE = 2;


    public function __construct() {
        $this->http_client = new CurlHttpClient(static::CONNECTION_TIMEOUT);
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
    public function getEvents($host, $key, $ts, $wait = 10) {
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

        return $this->ckeckLongpollResponse($params, $response);
    }

    /**
     * Decodes the Longpoll response and checks its status code and whether it has a failed key.
     *
     * @param array $params
     * @param TransportClientResponse $response
     *
     * @return mixed
     *
     * @throws LongPollServerTsException
     * @throws VKClientException
     * @throws LongPollServerKeyExpiredException
     */
    private function ckeckLongpollResponse($params, $response) {
        $this->checkHttpStatus($response);

        $body = $response->getBody();
        $decode_body = $this->decodeBody($body);

        if ($decode_body[static::FAILED_KEY]) {
            switch ($decode_body[static::FAILED_KEY]) {
                case static::INCORRECT_TS_VALUE_ERROR_CODE:
                    $ts = $params[static::API_PARAM_TS];
                    $msg = '\'ts\' value is incorrect, minimal value is 1, maximal value is ' . $ts;
                    throw new LongPollServerTsException($msg);
                case static::TOKEN_EXPIRED_ERROR_CODE:
                    throw new LongPollServerKeyExpiredException("Try to generate a new key.");
                default:
                    throw new VKClientException("Unknown LongPollServer exception, something went wrong.");
            }
        }

        return $decode_body;
    }
}
