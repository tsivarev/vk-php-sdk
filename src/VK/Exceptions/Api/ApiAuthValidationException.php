<?php

namespace VK\Exceptions\Api;

class ApiAuthValidationException extends VKApiException {
    public function __construct($message) {
        parent::__construct(17,  'Validation required',  $message);
    }
}
