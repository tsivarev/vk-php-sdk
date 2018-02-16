<?php

namespace VK\Exceptions\Api;

class ApiMarketTooManyAlbumsException extends VKApiException {
    public function __construct($message) {
        parent::__construct(1407,  'Too many albums',  $message);
    }
}
