<?php

namespace VK\Exceptions\Api;

class ApiAuthDelayException extends VKApiException {
    public function __construct($message) {
        parent::__construct(1112,  'Processing. Try later',  $message);
    }
}
