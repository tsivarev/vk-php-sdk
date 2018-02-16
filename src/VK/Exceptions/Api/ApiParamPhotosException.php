<?php

namespace VK\Exceptions\Api;

class ApiParamPhotosException extends VKApiException {
    public function __construct($message) {
        parent::__construct(122,  'Invalid photos',  $message);
    }
}
