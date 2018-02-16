<?php

namespace VK\Exceptions\Api;

class ApiMobileNotActivatedException extends VKApiException {
    public function __construct($message) {
        parent::__construct(146,  'The mobile number of the user is unknown',  $message);
    }
}
