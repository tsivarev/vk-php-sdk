<?php

namespace VK\Exceptions\Api;

class ApiBlockedException extends VkApiException {

    /**
     * ApiBlockedException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
		parent::__construct(19, 'Content blocked', $message);
	}
}
