<?php

namespace VK\Exceptions\Api;

class ApiAccessException extends VKApiException {
    public function __construct($message) {
        parent::__construct(15,  'Access denied',  $message);
    }
}
