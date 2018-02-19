<?php

namespace VK\Exceptions\Api;

class ApiAccessException extends VKApiException {
    /**
     * ApiAccessException constructor.
     * @param string $message
     **/
    public function __construct(string $message) {
        parent::__construct(15,  'Access denied',  $message);
    }
}
