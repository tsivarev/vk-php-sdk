<?php

namespace VK\Exceptions\Api;

class ApiParamUserIdException extends VKApiException {
    public function __construct($message) {
        parent::__construct(113,  'Invalid user id',  $message);
    }
}
