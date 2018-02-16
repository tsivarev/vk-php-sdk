<?php

namespace VK\Exceptions\Api;

class ApiPollsAnswerIdException extends VKApiException {
    public function __construct($message) {
        parent::__construct(252,  'Invalid answer id',  $message);
    }
}
