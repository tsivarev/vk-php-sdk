<?php

namespace VK\Exceptions\Api;

class ApiPhotoChangedException extends VKApiException {
    public function __construct($message) {
        parent::__construct(1160,  'Original photo was changed',  $message);
    }
}
