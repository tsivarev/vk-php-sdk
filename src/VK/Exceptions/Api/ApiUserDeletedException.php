<?php

namespace VK\Exceptions\Api;

class ApiUserDeletedException extends VKApiException {
    /**
     * ApiUserDeletedException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
        parent::__construct(18,  'User was deleted or banned',  $message);
    }
}
