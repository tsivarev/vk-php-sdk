<?php

namespace VK\Exceptions\Api;

class ApiParamDocAccessException extends VKApiException {
    public function __construct($message) {
        parent::__construct(1153,  'Access to document is denied',  $message);
    }
}
