<?php

namespace VK\Exceptions\Api;

class ApiVideoCommentsClosedException extends VKApiException {
    public function __construct($message) {
        parent::__construct(801,  'Comments for this video are closed',  $message);
    }
}
