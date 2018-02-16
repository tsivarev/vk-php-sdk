<?php

namespace VK\Exceptions\Api;

class ApiTooManyListsException extends VKApiException {
    public function __construct($message) {
        parent::__construct(1170,  'Too many feed lists',  $message);
    }
}
