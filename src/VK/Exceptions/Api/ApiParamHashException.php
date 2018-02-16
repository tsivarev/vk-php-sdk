<?php

namespace VK\Exceptions\Api;

class ApiParamHashException extends VKApiException {
    public function __construct($message) {
        parent::__construct(121,  'Invalid hash',  $message);
    }
}
