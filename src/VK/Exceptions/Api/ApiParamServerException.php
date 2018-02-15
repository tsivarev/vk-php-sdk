<?php

namespace VK\Exceptions\Api;

class ApiParamServerException extends VkApiException
{

    /**
     * ApiParamServerException constructor.
     * @param string $message
     */
    public function __construct(string $message)
    {
        parent::__construct(118, 'Invalid server', $message);
    }
}
