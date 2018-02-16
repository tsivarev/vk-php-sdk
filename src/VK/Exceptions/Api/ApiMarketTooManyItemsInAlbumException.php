<?php

namespace VK\Exceptions\Api;

class ApiMarketTooManyItemsInAlbumException extends VKApiException {
    public function __construct($message) {
        parent::__construct(1406,  'Too many items in album',  $message);
    }
}
