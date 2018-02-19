<?php

namespace VK\Exceptions\Api;

class ApiPollsAnswerIdException extends VKApiException {
    /**
     * ApiPollsAnswerIdException constructor.
     * @param string $message
     **/
    public function __construct(string $message) {
        parent::__construct(252,  'Invalid answer id',  $message);
    }
}
