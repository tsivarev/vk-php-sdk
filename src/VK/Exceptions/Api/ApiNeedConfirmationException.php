<?php

namespace VK\Exceptions\Api;

class ApiNeedConfirmationException extends VKApiException {
    public function __construct($message) {
        parent::__construct(24,  'Confirmation required',  $message);
    }
}
