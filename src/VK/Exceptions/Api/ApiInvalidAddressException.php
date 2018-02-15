<?php

namespace VK\Exceptions\Api;

class ApiInvalidAddressException extends VkApiException
{

    /**
     * ApiInvalidAddressException constructor.
     * @param string $message
     */
    public function __construct(string $message)
    {
        parent::__construct(1260, 'Invalid screen name', $message);
    }
}
