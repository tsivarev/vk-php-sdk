<?php

namespace VK\Exceptions\Api;

class ApiPhoneAlreadyUsedException extends VKApiException {
    public function __construct($message) {
        parent::__construct(1004,  'This phone number is used by another user',  $message);
    }
}
