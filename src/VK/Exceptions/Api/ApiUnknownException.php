<?php

namespace VK\Exceptions\Api;

class ApiUnknownException extends VKApiException {
    /**
     * ApiUnknownException constructor.
     * @param string $message
     **/
    public function __construct(string $message) {
        parent::__construct(1,  'Unknown error occurred',  $message);
    }
}
