<?php

namespace VK\Exceptions\Api;

class ApiFriendsAddYourselfException extends VKApiException {
    public function __construct($message) {
        parent::__construct(174,  'Cannot add user himself as friend',  $message);
    }
}
