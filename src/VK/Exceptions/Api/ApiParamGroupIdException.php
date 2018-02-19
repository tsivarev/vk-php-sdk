<?php

namespace VK\Exceptions\Api;

class ApiParamGroupIdException extends VKApiException {
    /**
     * ApiParamGroupIdException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
        parent::__construct(125,  'Invalid group id',  $message);
    }
}
