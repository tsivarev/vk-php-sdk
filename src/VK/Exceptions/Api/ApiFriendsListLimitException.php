<?php

namespace VK\Exceptions\Api;

class ApiFriendsListLimitException extends VKApiException {
    public function __construct($message) {
        parent::__construct(173,  'Reached the maximum number of lists',  $message);
    }
}
