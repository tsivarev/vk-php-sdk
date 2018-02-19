<?php

namespace VK\Exceptions\Api;

class ApiAuthValidationException extends VKApiException {
    /**
     * ApiAuthValidationException constructor.
     * @param string $message
     **/
    public function __construct(string $message) {
        parent::__construct(17,  'Validation required',  $message);
    }
}
