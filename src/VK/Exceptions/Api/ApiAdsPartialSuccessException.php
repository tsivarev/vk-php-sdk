<?php

namespace VK\Exceptions\Api;

class ApiAdsPartialSuccessException extends VKApiException {
    public function __construct($message) {
        parent::__construct(602,  'Some part of the request has not been completed',  $message);
    }
}
