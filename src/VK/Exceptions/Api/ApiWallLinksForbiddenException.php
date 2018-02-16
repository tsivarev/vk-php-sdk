<?php

namespace VK\Exceptions\Api;

class ApiWallLinksForbiddenException extends VKApiException {
    public function __construct($message) {
        parent::__construct(222,  'Hyperlinks are forbidden',  $message);
    }
}
