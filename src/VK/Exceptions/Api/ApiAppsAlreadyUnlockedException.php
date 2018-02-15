<?php

namespace VK\Exceptions\Api;

class ApiAppsAlreadyUnlockedException extends VkApiException
{

    /**
     * ApiAppsAlreadyUnlockedException constructor.
     * @param string $message
     */
    public function __construct(string $message)
    {
        parent::__construct(1251, 'This achievement is already unlocked', $message);
    }
}
