<?php

namespace VK\Exceptions\Api;

class ApiParamGroupIdException extends VKApiException {
    public function __construct($message) {
        parent::__construct(125,  'Invalid group id',  $message);
    }
}
