<?php

namespace VK\Exceptions\Api;

class ApiParamApiIdException extends VKApiException {
    public function __construct($message) {
        parent::__construct(101,  'Invalid application API ID',  $message);
    }
}
