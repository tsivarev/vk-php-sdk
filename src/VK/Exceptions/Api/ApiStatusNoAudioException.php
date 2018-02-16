<?php

namespace VK\Exceptions\Api;

class ApiStatusNoAudioException extends VKApiException {
    public function __construct($message) {
        parent::__construct(221,  'User disabled track name broadcast',  $message);
    }
}
