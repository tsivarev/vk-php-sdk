<?php

namespace VK\Exceptions\Api;

class ApiPhoneAlreadyUsedException extends VkApiException {

    /**
     * ApiPhoneAlreadyUsedException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
		parent::__construct(1004, 'This phone number is used by another user', $message);
	}
}
