<?php

namespace VK\Exceptions\Api;

class ApiFloodException extends VKApiException {
    public function __construct($message) {
        parent::__construct(9,  'Flood control',  $message);
    }
}
