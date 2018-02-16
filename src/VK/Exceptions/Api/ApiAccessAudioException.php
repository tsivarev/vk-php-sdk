<?php

namespace VK\Exceptions\Api;

class ApiAccessAudioException extends VKApiException {
    public function __construct($message) {
        parent::__construct(201,  'Access denied',  $message);
    }
}
