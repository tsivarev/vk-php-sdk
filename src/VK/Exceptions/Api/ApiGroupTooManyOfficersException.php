<?php

namespace VK\Exceptions\Api;

class ApiGroupTooManyOfficersException extends VkApiException
{

    /**
     * ApiGroupTooManyOfficersException constructor.
     * @param string $message
     */
    public function __construct(string $message)
    {
        parent::__construct(702, 'Too many officers in club', $message);
    }
}
