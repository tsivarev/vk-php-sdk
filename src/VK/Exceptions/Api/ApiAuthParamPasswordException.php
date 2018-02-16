<?php

namespace VK\Exceptions\Api;

class ApiAuthParamPasswordException extends VKApiException {
    public function __construct($message) {
        parent::__construct(1111,  'Invalid password',  $message);
    }
}
