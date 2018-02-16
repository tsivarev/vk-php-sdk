<?php

namespace VK\Exceptions\Api;

class ApiAccessGroupException extends VKApiException {
    public function __construct($message) {
        parent::__construct(203,  'Access to group denied',  $message);
    }
}
