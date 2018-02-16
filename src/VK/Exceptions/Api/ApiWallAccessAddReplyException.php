<?php

namespace VK\Exceptions\Api;

class ApiWallAccessAddReplyException extends VKApiException {
    public function __construct($message) {
        parent::__construct(213,  'Access to status replies denied',  $message);
    }
}
