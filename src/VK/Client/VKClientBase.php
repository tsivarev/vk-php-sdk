<?php

namespace VK\Client;

use VK\Exceptions\VKClientException;
use VK\TransportClient\TransportClientResponse;

class VKClientBase {
    protected const CONNECTION_TIMEOUT = 10;
    protected const HTTP_STATUS_CODE_OK = 200;

    protected $http_client;
    protected $api_version;

    /**
     * Decodes body.
     *
     * @param string
     *
     * @return mixed
     */
    protected function decodeBody($body) {
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
    protected function checkHttpStatus($response) {
        if ($response->getHttpStatus() != static::HTTP_STATUS_CODE_OK) {
            throw new VKClientException("Invalid http status: {$response->getHttpStatus()}");
        }
    }

    /**
     * Sets API version.
     *
     * @param string
     */
    public function setApiVersion($api_version) {
        $this->api_version = $api_version;
    }
}
