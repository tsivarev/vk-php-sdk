<?php

namespace VK\Exceptions\Api;

class ApiParamTimestampException extends VKApiException {
    /**
     * ApiParamTimestampException constructor.
     * @param string $message
     **/
    public function __construct(string $message) {
        parent::__construct(150,  'Invalid timestamp',  $message);
    }
}
