<?php

namespace VK\Exceptions\Api;

class ApiAuthException extends VKApiException {
    /**
     * ApiAuthException constructor.
     * @param string $message
     **/
    public function __construct(string $message) {
        parent::__construct(5,  'User authorization failed',  $message);
    }
}
