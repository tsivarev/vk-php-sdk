<?php

namespace VK\Exceptions\Api;

class ApiAccessNoteException extends VKApiException {
    /**
     * ApiAccessNoteException constructor.
     * @param string $message
     **/
    public function __construct(string $message) {
        parent::__construct(181,  'Access to note denied',  $message);
    }
}
