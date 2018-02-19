<?php

namespace VK\Exceptions\Api;

class ApiMarketTooManyAlbumsException extends VKApiException {
    /**
     * ApiMarketTooManyAlbumsException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
        parent::__construct(1407,  'Too many albums',  $message);
    }
}
