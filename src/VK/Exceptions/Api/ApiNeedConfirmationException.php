<?php

namespace VK\Exceptions\Api;

class ApiNeedConfirmationException extends VKApiException {
    /**
     * ApiNeedConfirmationException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
        parent::__construct(24,  'Confirmation required',  $message);
    }
}
