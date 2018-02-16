<?php

namespace VK\Exceptions\Api;

class ApiWallAccessRepliesException extends VKApiException {
    public function __construct($message) {
        parent::__construct(212,  'Access to post comments denied',  $message);
    }
}
