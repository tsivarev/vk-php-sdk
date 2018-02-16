<?php

namespace VK\Exceptions\Api;

class ApiAuthHttpsException extends VKApiException {
    public function __construct($message) {
        parent::__construct(16,  'HTTP authorization failed',  $message);
    }
}
