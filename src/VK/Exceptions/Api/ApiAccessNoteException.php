<?php

namespace VK\Exceptions\Api;

class ApiAccessNoteException extends VKApiException {
    public function __construct($message) {
        parent::__construct(181,  'Access to note denied',  $message);
    }
}
