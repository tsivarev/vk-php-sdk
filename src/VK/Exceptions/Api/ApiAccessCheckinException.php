<?php

namespace VK\Exceptions\Api;

class ApiAccessCheckinException extends VKApiException {
    /**
     * ApiAccessCheckinException constructor.
     * @param string $message
     **/
    public function __construct(string $message) {
        parent::__construct(191,  'Access to checkins denied',  $message);
    }
}
