<?php

namespace VK\Exceptions\Api;

class ApiAccessVideoException extends VKApiException {
    public function __construct($message) {
        parent::__construct(204,  'Access denied',  $message);
    }
}
