<?php

namespace VK\Exceptions\Api;

class ApiInvalidAddressException extends VKApiException {
    public function __construct($message) {
        parent::__construct(1260,  'Invalid screen name',  $message);
    }
}
