<?php

namespace VK\Exceptions;

class VKApiException extends \Exception {
    /**
     * @var string|null The error code.
     */
    protected $error_code;

    /**
     * @var string|null The error message.
     */
    protected $error_msg;

    /**
     * Creates a VKApiException.
     *
     * @param string|null The code of the error.
     * @param string|null The message of the error.
     */
    public function __construct($error_code, $error_msg) {
        $this->error_code = $error_code;
        $this->error_msg = $error_msg;
    }

    /**
     *
     * @return string|null
     *
     */
    public function getErrorCode() {
        return $this->error_code;
    }

    /**
     *
     * @return string|null
     *
     */
    public function getErrorMsg() {
        return $this->error_msg;
    }
}
