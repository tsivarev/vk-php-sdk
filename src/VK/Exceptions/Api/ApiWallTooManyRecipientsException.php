<?php

namespace VK\Exceptions\Api;

class ApiWallTooManyRecipientsException extends VKApiException {
    /**
     * ApiWallTooManyRecipientsException constructor.
     * @param string $message
     **/
    public function __construct(string $message) {
        parent::__construct(220,  'Too many recipients',  $message);
    }
}
