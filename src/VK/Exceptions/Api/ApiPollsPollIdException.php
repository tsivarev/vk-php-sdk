<?php

namespace VK\Exceptions\Api;

class ApiPollsPollIdException extends VKApiException {
    public function __construct($message) {
        parent::__construct(251,  'Invalid poll id',  $message);
    }
}
