<?php

namespace VK\Exceptions\Api;

class ApiFriendsAddEnemyException extends VKApiException {
    public function __construct($message) {
        parent::__construct(176,  'Cannot add this user to friends as you put him on blacklist',  $message);
    }
}
