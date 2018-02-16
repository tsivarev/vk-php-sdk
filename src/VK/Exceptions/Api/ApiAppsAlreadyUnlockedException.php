<?php

namespace VK\Exceptions\Api;

class ApiAppsAlreadyUnlockedException extends VKApiException {
    public function __construct($message) {
        parent::__construct(1251,  'This achievement is already unlocked',  $message);
    }
}
