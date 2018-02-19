<?php

namespace VK\Exceptions\Api;

class ApiCaptchaException extends VKApiException {
    /**
     * ApiCaptchaException constructor.
     * @param string $message
     **/
    public function __construct(string $message) {
        parent::__construct(14,  'Captcha needed',  $message);
    }
}
