<?php

namespace VK\Exceptions;

/**
 * Class VKClientException
 *
 * @package VK
 */
class VKApiException extends \Exception
{

    protected $error_code;
    protected $error_msg;

}
