<?php

namespace VK\Exceptions\Api;

class ApiFriendsAddInEnemyException extends VkApiException {

    /**
     * ApiFriendsAddInEnemyException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
		parent::__construct(175, 'Cannot add this user to friends as they have put you on their blacklist', $message);
	}
}
