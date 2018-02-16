<?php

namespace VK\Exceptions\Api;

class ApiMethodException extends VKApiException {
    public function __construct($message) {
        parent::__construct(3,  'Unknown method passed',  $message);
    }
}
