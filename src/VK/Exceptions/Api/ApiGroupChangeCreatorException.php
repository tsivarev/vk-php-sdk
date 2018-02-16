<?php

namespace VK\Exceptions\Api;

class ApiGroupChangeCreatorException extends VKApiException {
    public function __construct($message) {
        parent::__construct(700,  'Cannot edit creator role',  $message);
    }
}
