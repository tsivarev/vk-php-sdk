<?php

namespace VK\Exceptions\Api;

class ApiWallAccessCommentException extends VKApiException {
    public function __construct($message) {
        parent::__construct(211,  'Access to wall\'s comment denied',  $message);
    }
}
