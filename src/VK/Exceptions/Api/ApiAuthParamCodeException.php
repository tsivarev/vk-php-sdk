<?php

namespace VK\Exceptions\Api;

class ApiAuthParamCodeException extends VKApiException {
    public function __construct($message) {
        parent::__construct(1110,  'Incorrect code',  $message);
    }
}
