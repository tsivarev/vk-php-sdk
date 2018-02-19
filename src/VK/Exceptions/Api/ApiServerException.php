<?php

namespace VK\Exceptions\Api;

class ApiServerException extends VKApiException {
    /**
     * ApiServerException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
        parent::__construct(10,  'Internal server error',  $message);
    }
}
