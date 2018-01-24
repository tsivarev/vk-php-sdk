<?php

namespace VK\TransportClient;

class TransportClientResponse {
    private $http_status;

    private $headers;

    private $body;

    public function __construct($http_status, $headers, $body) {
        $this->http_status = $http_status;
        $this->headers = $headers;
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getBody() {
        return $this->body;
    }

    /**
     * @return mixed
     */
    public function getHttpStatus() {
        return $this->http_status;
    }

    /**
     * @return mixed
     */
    public function getHeaders() {
        return $this->headers;
    }
}
