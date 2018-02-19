<?php

namespace VK\Exceptions\Api;

class ApiParamUserIdException extends VKApiException {
    /**
     * ApiParamUserIdException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
        parent::__construct(113,  'Invalid user id',  $message);
    }
}
