<?php

namespace VK\Exceptions\Api;

class ApiParamServerException extends VKApiException {
    public function __construct($message) {
        parent::__construct(118,  'Invalid server',  $message);
    }
}
