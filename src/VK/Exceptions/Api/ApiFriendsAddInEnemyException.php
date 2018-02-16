<?php

namespace VK\Exceptions\Api;

class ApiFriendsAddInEnemyException extends VKApiException {
    public function __construct($message) {
        parent::__construct(175,  'Cannot add this user to friends as they have put you on their blacklist',  $message);
    }
}
