<?php

namespace VK\Exceptions\Api;

class ApiWallAddPostException extends VKApiException {
    /**
     * ApiWallAddPostException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
        parent::__construct(214,  'Access to adding post denied',  $message);
    }
}
