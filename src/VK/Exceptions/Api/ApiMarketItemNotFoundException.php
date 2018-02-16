<?php

namespace VK\Exceptions\Api;

class ApiMarketItemNotFoundException extends VKApiException {
    public function __construct($message) {
        parent::__construct(1403,  'Item not found',  $message);
    }
}
