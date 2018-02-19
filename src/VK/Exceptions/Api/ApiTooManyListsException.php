<?php

namespace VK\Exceptions\Api;

class ApiTooManyListsException extends VKApiException {
    /**
     * ApiTooManyListsException constructor.
     * @param string $message
     **/
    public function __construct(string $message) {
        parent::__construct(1170,  'Too many feed lists',  $message);
    }
}
