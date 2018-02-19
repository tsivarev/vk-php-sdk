<?php

namespace VK\Exceptions\Api;

class ApiPollsAccessException extends VKApiException {
    /**
     * ApiPollsAccessException constructor.
     * @param string $message
     **/
    public function __construct(string $message) {
        parent::__construct(250,  'Access to poll denied',  $message);
    }
}
