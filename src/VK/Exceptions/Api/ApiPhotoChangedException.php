<?php

namespace VK\Exceptions\Api;

class ApiPhotoChangedException extends VkApiException
{

    /**
     * ApiPhotoChangedException constructor.
     * @param string $message
     */
    public function __construct(string $message)
    {
        parent::__construct(1160, 'Original photo was changed', $message);
    }
}
