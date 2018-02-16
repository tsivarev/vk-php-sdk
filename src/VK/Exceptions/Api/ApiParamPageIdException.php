<?php

namespace VK\Exceptions\Api;

class ApiParamPageIdException extends VKApiException {
    public function __construct($message) {
        parent::__construct(140,  'Page not found',  $message);
    }
}
