<?php

namespace VK\Exceptions\Api;

class ApiAccessPageException extends VKApiException {
    /**
     * ApiAccessPageException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
        parent::__construct(141,  'Access to page denied',  $message);
    }
}
