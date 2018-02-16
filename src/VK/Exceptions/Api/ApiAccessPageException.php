<?php

namespace VK\Exceptions\Api;

class ApiAccessPageException extends VKApiException {
    public function __construct($message) {
        parent::__construct(141,  'Access to page denied',  $message);
    }
}
