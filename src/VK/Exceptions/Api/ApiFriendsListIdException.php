<?php

namespace VK\Exceptions\Api;

class ApiFriendsListIdException extends VKApiException {
    /**
     * ApiFriendsListIdException constructor.
     * @param string $message
     **/
    public function __construct(string $message) {
        parent::__construct(171,  'Invalid list id',  $message);
    }
}
