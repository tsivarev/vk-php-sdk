<?php

namespace VK\Exceptions\Api;

class ApiAccessNoteCommentException extends VKApiException {
    /**
     * ApiAccessNoteCommentException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
        parent::__construct(182,  'You can\'t comment this note',  $message);
    }
}
