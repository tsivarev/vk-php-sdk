<?php

namespace VK\Exceptions\Api;

class ApiAdsPartialSuccessException extends VKApiException {
    /**
     * ApiAdsPartialSuccessException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
        parent::__construct(602,  'Some part of the request has not been completed',  $message);
    }
}
