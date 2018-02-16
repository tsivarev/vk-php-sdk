<?php

namespace VK\Exceptions\Api;

class ApiLimitsException extends VKApiException {
    public function __construct($message) {
        parent::__construct(103,  'Out of limits',  $message);
    }
}
