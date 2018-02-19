<?php

namespace VK\Exceptions\Api;

class ApiWallAccessCommentException extends VKApiException {
    /**
     * ApiWallAccessCommentException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
        parent::__construct(211,  'Access to wall\'s comment denied',  $message);
    }
}
