<?php

namespace VK\Exceptions\Api;

class ApiMarketItemNotFoundException extends VkApiException {

    /**
     * ApiMarketItemNotFoundException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
		parent::__construct(1403, 'Item not found', $message);
	}
}
