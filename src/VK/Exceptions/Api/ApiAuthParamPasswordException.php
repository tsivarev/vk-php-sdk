<?php

namespace VK\Exceptions\Api;

class ApiAuthParamPasswordException extends VKApiException {
    /**
     * ApiAuthParamPasswordException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
        parent::__construct(1111,  'Invalid password',  $message);
    }
}
