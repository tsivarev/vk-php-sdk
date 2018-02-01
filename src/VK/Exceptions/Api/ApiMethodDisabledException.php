<?php

namespace VK\Exceptions\Api;

class ApiMethodDisabledException extends VKApiException {
    public function __construct($message) {
        parent::__construct(23,  'This method was disabled',  $message);
    }
}
