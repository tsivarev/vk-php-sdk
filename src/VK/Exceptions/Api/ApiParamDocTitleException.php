<?php

namespace VK\Exceptions\Api;

class ApiParamDocTitleException extends VKApiException {
    public function __construct($message) {
        parent::__construct(1152,  'Invalid document title',  $message);
    }
}
