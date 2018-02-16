<?php

namespace VK\Exceptions\Api;

class ApiUserDeletedException extends VKApiException {
    public function __construct($message) {
        parent::__construct(18,  'User was deleted or banned',  $message);
    }
}
