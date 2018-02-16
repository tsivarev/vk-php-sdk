<?php

namespace VK\Exceptions\Api;

class ApiMessagesForwardException extends VKApiException {
    public function __construct($message) {
        parent::__construct(921,  'Can\'t forward these messages',  $message);
    }
}
