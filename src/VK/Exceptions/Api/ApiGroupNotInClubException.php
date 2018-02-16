<?php

namespace VK\Exceptions\Api;

class ApiGroupNotInClubException extends VKApiException {
    public function __construct($message) {
        parent::__construct(701,  'User should be in club',  $message);
    }
}
