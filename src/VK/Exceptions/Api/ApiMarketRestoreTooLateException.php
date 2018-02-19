<?php

namespace VK\Exceptions\Api;

class ApiMarketRestoreTooLateException extends VKApiException {
    /**
     * ApiMarketRestoreTooLateException constructor.
     * @param string $message
     **/
    public function __construct(string $message) {
        parent::__construct(1400,  'Too late for restore',  $message);
    }
}
