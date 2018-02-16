<?php

namespace VK\Exceptions\Api;

class ApiMarketCommentsClosedException extends VKApiException {
    public function __construct($message) {
        parent::__construct(1401,  'Comments for this market are closed',  $message);
    }
}
