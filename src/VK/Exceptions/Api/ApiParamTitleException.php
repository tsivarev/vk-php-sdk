<?php

namespace VK\Exceptions\Api;

class ApiParamTitleException extends VKApiException {
    /**
     * ApiParamTitleException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
        parent::__construct(119,  'Invalid title',  $message);
    }
}
