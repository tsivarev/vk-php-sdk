<?php

namespace VK\Exceptions\Api;

class ApiMarketRestoreTooLateException extends VKApiException {
    public function __construct($message) {
        parent::__construct(1400,  'Too late for restore',  $message);
    }
}
