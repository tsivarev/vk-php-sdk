<?php

namespace VK\Exceptions\Api;

class ApiAccessMenuException extends VkApiException {

    /**
     * ApiAccessMenuException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
		parent::__construct(148, 'Access to the menu of the user denied', $message);
	}
}
