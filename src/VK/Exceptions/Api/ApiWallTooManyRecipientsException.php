<?php

namespace VK\Exceptions\Api;

class ApiWallTooManyRecipientsException extends VKApiException {
    public function __construct($message) {
        parent::__construct(220,  'Too many recipients',  $message);
    }
}
