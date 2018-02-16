<?php

namespace VK\Exceptions\Api;

class ApiActionFailedException extends VKApiException {
    public function __construct($message) {
        parent::__construct(106,  'Unable to process action',  $message);
    }
}
