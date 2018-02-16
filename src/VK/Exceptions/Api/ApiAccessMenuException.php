<?php

namespace VK\Exceptions\Api;

class ApiAccessMenuException extends VKApiException {
    public function __construct($message) {
        parent::__construct(148,  'Access to the menu of the user denied',  $message);
    }
}
