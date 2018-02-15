<?php

namespace VK\Exceptions\Api;

class ApiActionFailedException extends VkApiException {

    /**
     * ApiActionFailedException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
		parent::__construct(106, 'Unable to process action', $message);
	}
}
