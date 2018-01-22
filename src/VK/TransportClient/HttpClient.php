<?php

namespace VK\TransportClient;

/**
 * Class HttpClient
 *
 * @package VK
 */
class HttpClient {

    private $raw_response;
    private $curl_error_code;
    private $curl_error;

    /**
     *
     * @param string $url
     * @param array $options
     *
     */
    public function post($url, $payload) {
        $curl = curl_init($url);
        curl_setopt_array($curl, $payload);
        $this->raw_response = curl_exec($curl);

        $this->curl_error_code = curl_errno($curl);
        $this->curl_error = curl_error($curl);

        curl_close($curl);
    }

    public function getRawResponse() {
        return $this->raw_response;
    }

    public function getErrorCode() {
        return $this->curl_error_code;
    }

    public function getError() {
        return $this->curl_error;
    }
}
