<?php

namespace VK\Exceptions\Api;

class ApiAccessCommentException extends VKApiException {
    public function __construct($message) {
        parent::__construct(183,  'Access to comment denied',  $message);
    }
}
