<?php

namespace VK\Exceptions\Api;

class ApiMarketTooManyItemsException extends VKApiException {
    /**
     * ApiMarketTooManyItemsException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
        parent::__construct(1405,  'Too many items',  $message);
    }
}
