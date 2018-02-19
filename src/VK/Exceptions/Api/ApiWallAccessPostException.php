<?php

namespace VK\Exceptions\Api;

class ApiWallAccessPostException extends VKApiException {
    /**
     * ApiWallAccessPostException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
        parent::__construct(210,  'Access to wall\'s post denied',  $message);
    }
}
