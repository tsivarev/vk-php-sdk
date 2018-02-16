<?php

namespace VK\Exceptions\Api;

class ApiMarketItemAlreadyAddedException extends VKApiException {
    public function __construct($message) {
        parent::__construct(1404,  'Item already added to album',  $message);
    }
}
