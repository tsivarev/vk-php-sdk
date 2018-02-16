<?php

namespace VK\Exceptions\Api;

class ApiParamNoteIdException extends VKApiException {
    public function __construct($message) {
        parent::__construct(180,  'Note not found',  $message);
    }
}
