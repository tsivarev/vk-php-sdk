<?php

namespace VK\Exceptions\Api;

class ApiSameCheckinException extends VKApiException {
    public function __construct($message) {
        parent::__construct(190,  'You have sent same checkin in last 10 minutes',  $message);
    }
}
