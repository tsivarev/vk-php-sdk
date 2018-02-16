<?php

namespace VK\Exceptions\Api;

class ApiPollsAccessException extends VKApiException {
    public function __construct($message) {
        parent::__construct(250,  'Access to poll denied',  $message);
    }
}
