<?php

namespace VK\Exceptions\Api;

class ApiMarketItemAlreadyAddedException extends VkApiException {

    /**
     * ApiMarketItemAlreadyAddedException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
		parent::__construct(1404, 'Item already added to album', $message);
	}
}
