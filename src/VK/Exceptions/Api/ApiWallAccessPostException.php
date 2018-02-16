<?php

namespace VK\Exceptions\Api;

class ApiWallAccessPostException extends VKApiException {
    public function __construct($message) {
        parent::__construct(210,  'Access to wall\'s post denied',  $message);
    }
}
