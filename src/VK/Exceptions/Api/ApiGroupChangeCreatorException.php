<?php

namespace VK\Exceptions\Api;

class ApiGroupChangeCreatorException extends VKApiException {
    /**
     * ApiGroupChangeCreatorException constructor.
     * @param string $message
     **/
    public function __construct(string $message) {
        parent::__construct(700,  'Cannot edit creator role',  $message);
    }
}
