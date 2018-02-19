<?php

namespace VK\Exceptions\Api;

class ApiInsufficientFundsException extends VKApiException {
    /**
     * ApiInsufficientFundsException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
        parent::__construct(147,  'Application has insufficient funds',  $message);
    }
}
