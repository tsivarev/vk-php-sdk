<?php

namespace VK\Exceptions\Api;

class ApiCaptchaException extends VKApiException {
    public function __construct($message) {
        parent::__construct(14,  'Captcha needed',  $message);
    }
}
