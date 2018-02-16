<?php

namespace VK\Exceptions\Api;

class ApiBlockedException extends VKApiException {
    public function __construct($message) {
        parent::__construct(19,  'Content blocked',  $message);
    }
}
