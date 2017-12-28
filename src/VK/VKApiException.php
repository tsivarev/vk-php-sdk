<?php

namespace VK\Exceptions;

/**
 * Class VKApiException
 *
 * @package VK
 */
class VKApiException extends \Exception
{
    /**
     * @var string|boolean The error code.
     */
    protected $error_code;

    /**
     * @var string|boolean The error message.
     */
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
