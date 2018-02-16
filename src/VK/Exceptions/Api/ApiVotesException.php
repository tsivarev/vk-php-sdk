<?php

namespace VK\Exceptions\Api;

class ApiVotesException extends VKApiException {
    public function __construct($message) {
        parent::__construct(503,  'Not enough votes',  $message);
    }
}
