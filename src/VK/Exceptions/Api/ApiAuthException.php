<?php

namespace VK\Exceptions\Api;

class ApiAuthException extends VKApiException {
    public function __construct($message) {
        parent::__construct(5,  'User authorization failed',  $message);
    }
}
