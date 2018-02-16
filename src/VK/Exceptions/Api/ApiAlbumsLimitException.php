<?php

namespace VK\Exceptions\Api;

class ApiAlbumsLimitException extends VKApiException {
    public function __construct($message) {
        parent::__construct(302,  'Albums number limit is reached',  $message);
    }
}
