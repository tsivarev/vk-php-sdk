<?php

namespace VK\Exceptions\Api;

class ApiMarketTooManyAlbumsException extends VkApiException {

    /**
     * ApiMarketTooManyAlbumsException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
		parent::__construct(1407, 'Too many albums', $message);
	}
}
