<?php

namespace VK\Exceptions\Api;

class ApiParamNoteIdException extends VKApiException {
    /**
     * ApiParamNoteIdException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
        parent::__construct(180,  'Note not found',  $message);
    }
}
