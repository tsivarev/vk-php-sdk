<?php

namespace VK\Exceptions\Api;

class ApiServerException extends VKApiException {
    public function __construct($message) {
        parent::__construct(10,  'Internal server error',  $message);
    }
}
