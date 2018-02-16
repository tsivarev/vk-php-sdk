<?php

namespace VK\Exceptions\Api;

class ApiInsufficientFundsException extends VKApiException {
    public function __construct($message) {
        parent::__construct(147,  'Application has insufficient funds',  $message);
    }
}
