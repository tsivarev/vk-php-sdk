<?php

namespace VK\Exceptions\Api;

class ApiAccessMarketException extends VKApiException {
    public function __construct($message) {
        parent::__construct(205,  'Access denied',  $message);
    }
}
