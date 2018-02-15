<?php

namespace VK\Exceptions\Api;

class ApiMessagesPrivacyException extends VkApiException {

    /**
     * ApiMessagesPrivacyException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
		parent::__construct(902, 'Can\'t send messages to this user due to their privacy settings', $message);
	}
}
