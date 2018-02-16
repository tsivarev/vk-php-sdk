<?php

namespace VK\Exceptions\Api;

class ApiFriendsListIdException extends VKApiException {
    public function __construct($message) {
        parent::__construct(171,  'Invalid list id',  $message);
    }
}
