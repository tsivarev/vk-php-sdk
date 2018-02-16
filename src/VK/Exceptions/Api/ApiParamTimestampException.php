<?php

namespace VK\Exceptions\Api;

class ApiParamTimestampException extends VKApiException {
    public function __construct($message) {
        parent::__construct(150,  'Invalid timestamp',  $message);
    }
}
