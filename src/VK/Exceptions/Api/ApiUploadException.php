<?php

namespace VK\Exceptions\Api;

class ApiUploadException extends VKApiException {
    public function __construct($message) {
        parent::__construct(22,  'Upload error',  $message);
    }
}
