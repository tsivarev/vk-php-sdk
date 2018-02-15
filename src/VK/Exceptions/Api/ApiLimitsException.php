<?php

namespace VK\Exceptions\Api;

class ApiLimitsException extends VkApiException {

    /**
     * ApiLimitsException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
		parent::__construct(103, 'Out of limits', $message);
	}
}
