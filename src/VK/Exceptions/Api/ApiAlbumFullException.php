<?php

namespace VK\Exceptions\Api;

class ApiAlbumFullException extends VKApiException {
    /**
     * ApiAlbumFullException constructor.
     * @param string $message
     **/
    public function __construct(string $message) {
        parent::__construct(300,  'This album is full',  $message);
    }
}
