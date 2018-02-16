<?php

namespace VK\Exceptions\Api;

class ApiAccessNoteCommentException extends VKApiException {
    public function __construct($message) {
        parent::__construct(182,  'You can\'t comment this note',  $message);
    }
}
