<?php

namespace VK\Exceptions\Api;

class ApiMessagesForwardAmountExceededException extends VKApiException {
    public function __construct($message) {
        parent::__construct(913,  'Too many forwarded messages',  $message);
    }
}
