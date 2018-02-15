<?php

namespace VK\Exceptions\Api;

class ApiVideoCommentsClosedException extends VkApiException
{

    /**
     * ApiVideoCommentsClosedException constructor.
     * @param string $message
     */
    public function __construct(string $message)
    {
        parent::__construct(801, 'Comments for this video are closed', $message);
    }
}
