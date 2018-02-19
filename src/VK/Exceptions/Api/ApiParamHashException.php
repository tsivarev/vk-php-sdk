<?php

namespace VK\Exceptions\Api;

class ApiParamHashException extends VKApiException {
    /**
     * ApiParamHashException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
        parent::__construct(121,  'Invalid hash',  $message);
    }
}
