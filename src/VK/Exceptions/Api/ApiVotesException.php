<?php

namespace VK\Exceptions\Api;

class ApiVotesException extends VkApiException {

    /**
     * ApiVotesException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
		parent::__construct(503, 'Not enough votes', $message);
	}
}
