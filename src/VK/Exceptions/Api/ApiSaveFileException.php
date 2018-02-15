<?php

namespace VK\Exceptions\Api;

class ApiSaveFileException extends VkApiException
{

    /**
     * ApiSaveFileException constructor.
     * @param string $message
     */
    public function __construct(string $message)
    {
        parent::__construct(105, 'Couldn\'t save file', $message);
    }
}
