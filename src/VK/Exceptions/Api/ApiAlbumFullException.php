<?php

namespace VK\Exceptions\Api;

class ApiAlbumFullException extends VKApiException {
    public function __construct($message) {
        parent::__construct(300,  'This album is full',  $message);
    }
}
