<?php

namespace VK\Exceptions\Api;

class ApiParamAlbumIdException extends VKApiException {
    /**
     * ApiParamAlbumIdException constructor.
     * @param string $message
     **/
    public function __construct(string $message) {
        parent::__construct(114,  'Invalid album id',  $message);
    }
}
