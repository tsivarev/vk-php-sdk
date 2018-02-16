<?php

namespace VK\Exceptions\Api;

class ApiSignatureException extends VKApiException {
    public function __construct($message) {
        parent::__construct(4,  'Incorrect signature',  $message);
    }
}
