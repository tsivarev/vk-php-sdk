<?php

namespace VK\Exceptions\Api;

class ApiAuthFloodException extends VKApiException {
    public function __construct($message) {
        parent::__construct(1105,  'Too many auth attempts, try again later',  $message);
    }
}
