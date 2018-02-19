<?php

namespace VK\Exceptions\Api;

class ApiAuthDelayException extends VKApiException {
    /**
     * ApiAuthDelayException constructor.
     * @param string $message
     **/
    public function __construct(string $message) {
        parent::__construct(1112,  'Processing. Try later',  $message);
    }
}
