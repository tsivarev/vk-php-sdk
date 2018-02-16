<?php

namespace VK\Exceptions\Api;

class ApiParamPhotoException extends VKApiException {
    public function __construct($message) {
        parent::__construct(129,  'Invalid photo',  $message);
    }
}
