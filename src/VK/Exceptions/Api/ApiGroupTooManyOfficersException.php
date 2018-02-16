<?php

namespace VK\Exceptions\Api;

class ApiGroupTooManyOfficersException extends VKApiException {
    public function __construct($message) {
        parent::__construct(702,  'Too many officers in club',  $message);
    }
}
