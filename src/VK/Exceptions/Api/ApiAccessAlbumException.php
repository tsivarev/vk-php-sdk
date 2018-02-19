<?php

namespace VK\Exceptions\Api;

class ApiAccessAlbumException extends VKApiException {
    /**
     * ApiAccessAlbumException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
        parent::__construct(200,  'Access denied',  $message);
    }
}
