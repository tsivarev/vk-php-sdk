<?php

namespace VK\Exceptions\Api;

class ApiWallAdsPublishedException extends VKApiException {
    /**
     * ApiWallAdsPublishedException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
        parent::__construct(219,  'Advertisement post was recently added',  $message);
    }
}
