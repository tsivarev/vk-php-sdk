<?php

namespace VK\Exceptions\Api;

class ApiParamHashException extends VkApiException
{

    /**
     * ApiParamHashException constructor.
     * @param string $message
     */
    public function __construct(string $message)
    {
        parent::__construct(121, 'Invalid hash', $message);
    }
}
