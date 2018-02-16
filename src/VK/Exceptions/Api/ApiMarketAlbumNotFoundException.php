<?php

namespace VK\Exceptions\Api;

class ApiMarketAlbumNotFoundException extends VKApiException {
    public function __construct($message) {
        parent::__construct(1402,  'Album not found',  $message);
    }
}
