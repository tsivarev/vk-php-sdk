<?php

namespace VK\Exceptions\Api;

class ApiSameCheckinException extends VKApiException {
    /**
     * ApiSameCheckinException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
        parent::__construct(190,  'You have sent same checkin in last 10 minutes',  $message);
    }
}
