<?php

namespace VK\Exceptions\Api;

class ApiSaveFileException extends VKApiException {
    public function __construct($message) {
        parent::__construct(105,  'Couldn\'t save file',  $message);
    }
}
