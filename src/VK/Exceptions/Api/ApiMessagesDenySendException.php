<?php

namespace VK\Exceptions\Api;

class ApiMessagesDenySendException extends VKApiException {
    public function __construct($message) {
        parent::__construct(901,  'Can\'t send messages for users without dialogs',  $message);
    }
}
