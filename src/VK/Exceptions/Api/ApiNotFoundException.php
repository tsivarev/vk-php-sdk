<?php

namespace VK\Exceptions\Api;

class ApiNotFoundException extends VKApiException {
    public function __construct($message) {
        parent::__construct(104,  'Not found',  $message);
    }
}
