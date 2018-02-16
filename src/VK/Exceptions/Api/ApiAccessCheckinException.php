<?php

namespace VK\Exceptions\Api;

class ApiAccessCheckinException extends VKApiException {
    public function __construct($message) {
        parent::__construct(191,  'Access to checkins denied',  $message);
    }
}
