<?php

namespace VK\Exceptions\Api;

class ApiRequestException extends VKApiException {
    public function __construct($message) {
        parent::__construct(8,  'Invalid request',  $message);
    }
}
