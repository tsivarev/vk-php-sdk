<?php

namespace VK\Exceptions\Api;

class ApiWallAdsPublishedException extends VKApiException {
    public function __construct($message) {
        parent::__construct(219,  'Advertisement post was recently added',  $message);
    }
}
