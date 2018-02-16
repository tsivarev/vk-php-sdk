<?php

namespace VK\Exceptions\Api;

class ApiParamDocDeleteAccessException extends VKApiException {
    public function __construct($message) {
        parent::__construct(1151,  'Access to document deleting is denied',  $message);
    }
}
