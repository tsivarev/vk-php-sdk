<?php

namespace VK\Exceptions\Api;

class ApiWallAddPostException extends VKApiException {
    public function __construct($message) {
        parent::__construct(214,  'Access to adding post denied',  $message);
    }
}
