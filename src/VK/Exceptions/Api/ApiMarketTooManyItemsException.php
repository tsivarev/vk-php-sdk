<?php

namespace VK\Exceptions\Api;

class ApiMarketTooManyItemsException extends VKApiException {
    public function __construct($message) {
        parent::__construct(1405,  'Too many items',  $message);
    }
}
