<?php

namespace VK\Exceptions\Api;

class ApiAccessMarketException extends VKApiException {
    /**
     * ApiAccessMarketException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
        parent::__construct(205,  'Access denied',  $message);
    }
}
