<?php

namespace VK\Exceptions;

/**
 * Class VKApiException
 *
 * @package VK
 */
class VKApiException extends \Exception
{

    protected $error_code;
    protected $error_msg;

    /**
     * Creates a VKApiException.
     *
     * @param string|null The code of the error.
     * @param string|null The message of the error.
     */
    public function __construct($error_code, $error_msg)
    {
        $this->error_code = $error_code;
        $this->error_msg = $error_msg;
    }
}
