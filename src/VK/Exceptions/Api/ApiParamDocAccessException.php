<?php

namespace VK\Exceptions\Api;

class ApiParamDocAccessException extends VkApiException
{

    /**
     * ApiParamDocAccessException constructor.
     * @param string $message
     */
    public function __construct(string $message)
    {
        parent::__construct(1153, 'Access to document is denied', $message);
    }
}
