<?php

namespace VK\Exceptions\Api;

class ApiMessagesForwardException extends VkApiException {

    /**
     * ApiMessagesForwardException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
		parent::__construct(921, 'Can\'t forward these messages', $message);
	}
}
