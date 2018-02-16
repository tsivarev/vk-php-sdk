<?php

namespace VK\Exceptions\Api;

class ApiParamTitleException extends VKApiException {
    public function __construct($message) {
        parent::__construct(119,  'Invalid title',  $message);
    }
}
