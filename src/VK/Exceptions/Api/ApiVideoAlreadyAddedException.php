<?php

namespace VK\Exceptions\Api;

class ApiVideoAlreadyAddedException extends VKApiException {
    public function __construct($message) {
        parent::__construct(800,  'This video is already added',  $message);
    }
}
