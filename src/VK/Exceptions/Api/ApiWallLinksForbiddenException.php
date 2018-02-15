<?php

namespace VK\Exceptions\Api;

class ApiWallLinksForbiddenException extends VkApiException
{

    /**
     * ApiWallLinksForbiddenException constructor.
     * @param string $message
     */
    public function __construct(string $message)
    {
        parent::__construct(222, 'Hyperlinks are forbidden', $message);
    }
}
