<?php

namespace VK\Exceptions\Api;

class ApiPollsPollIdException extends VKApiException {
    /**
     * ApiPollsPollIdException constructor.
     * @param string $message
     **/
    public function __construct(string $message) {
        parent::__construct(251,  'Invalid poll id',  $message);
    }
}
