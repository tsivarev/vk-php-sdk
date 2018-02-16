<?php

namespace VK\Exceptions\Api;

class ApiMessagesPrivacyException extends VKApiException {
    public function __construct($message) {
        parent::__construct(902,  'Can\'t send messages to this user due to their privacy settings',  $message);
    }
}
