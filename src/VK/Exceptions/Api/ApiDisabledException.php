<?php

namespace VK\Exceptions\Api;

class ApiDisabledException extends VKApiException {
    /**
     * ApiDisabledException constructor.
     * @param string $message
     **/
    public function __construct(string $message) {
        parent::__construct(2,  'Application is disabled. Enable your application or use test mode',  $message);
    }
}
