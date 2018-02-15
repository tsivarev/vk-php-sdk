<?php

namespace VK\Exceptions\Api;

class ApiTooManyListsException extends VkApiException {

    /**
     * ApiTooManyListsException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
		parent::__construct(1170, 'Too many feed lists', $message);
	}
}
