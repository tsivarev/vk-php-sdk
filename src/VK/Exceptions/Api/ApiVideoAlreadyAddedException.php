<?php

namespace VK\Exceptions\Api;

class ApiVideoAlreadyAddedException extends VkApiException {

    /**
     * ApiVideoAlreadyAddedException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
		parent::__construct(800, 'This video is already added', $message);
	}
}
