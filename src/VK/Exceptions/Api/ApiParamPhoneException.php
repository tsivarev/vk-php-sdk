<?php

namespace VK\Exceptions\Api;

class ApiParamPhoneException extends VKApiException {
    public function __construct($message) {
        parent::__construct(1000,  'Invalid phone number',  $message);
    }
}
