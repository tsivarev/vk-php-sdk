<?php

namespace VK\Exceptions\Api;

class ApiAuthFloodException extends VkApiException {

    /**
     * ApiAuthFloodException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
		parent::__construct(1105, 'Too many auth attempts, try again later', $message);
	}
}
