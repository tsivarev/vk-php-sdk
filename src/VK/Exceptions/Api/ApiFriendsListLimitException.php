<?php

namespace VK\Exceptions\Api;

class ApiFriendsListLimitException extends VKApiException {
    /**
     * ApiFriendsListLimitException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
        parent::__construct(173,  'Reached the maximum number of lists',  $message);
    }
}
