<?php

namespace VK\Exceptions\Api;

class ApiParamDocIdException extends VKApiException {
    public function __construct($message) {
        parent::__construct(1150,  'Invalid document id',  $message);
    }
}
