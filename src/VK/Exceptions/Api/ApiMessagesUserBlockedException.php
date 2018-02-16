<?php

namespace VK\Exceptions\Api;

class ApiMessagesUserBlockedException extends VKApiException {
    public function __construct($message) {
        parent::__construct(900,  'Can\'t send messages for users from blacklist',  $message);
    }
}
