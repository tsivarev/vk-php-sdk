<?php

namespace VK\Exceptions\Api;

class ApiMarketTooManyItemsInAlbumException extends VkApiException
{

    /**
     * ApiMarketTooManyItemsInAlbumException constructor.
     * @param string $message
     */
    public function __construct(string $message)
    {
        parent::__construct(1406, 'Too many items in album', $message);
    }
}
