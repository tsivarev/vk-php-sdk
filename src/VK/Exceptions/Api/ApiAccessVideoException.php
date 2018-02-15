<?php

namespace VK\Exceptions\Api;

class ApiAccessVideoException extends VkApiException
{

    /**
     * ApiAccessVideoException constructor.
     * @param string $message
     */
    public function __construct(string $message)
    {
        parent::__construct(204, 'Access denied', $message);
    }
}
