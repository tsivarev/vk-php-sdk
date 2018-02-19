<?php

namespace VK\Exceptions\Api;

class ApiMarketAlbumNotFoundException extends VKApiException {
    /**
     * ApiMarketAlbumNotFoundException constructor.
     * @param string $message
     **/
    public function __construct(string $message) {
        parent::__construct(1402,  'Album not found',  $message);
    }
}
