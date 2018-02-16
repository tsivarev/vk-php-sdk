<?php

namespace VK\Exceptions\Api;

class ApiParamAlbumIdException extends VKApiException {
    public function __construct($message) {
        parent::__construct(114,  'Invalid album id',  $message);
    }
}
