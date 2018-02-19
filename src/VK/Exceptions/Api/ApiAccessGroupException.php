<?php

namespace VK\Exceptions\Api;

class ApiAccessGroupException extends VKApiException {
    /**
     * ApiAccessGroupException constructor.
     * @param string $message
     **/
    public function __construct(string $message) {
        parent::__construct(203,  'Access to group denied',  $message);
    }
}
