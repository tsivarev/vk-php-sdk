<?php

namespace VK\Exceptions\Api;

class ApiAlbumsLimitException extends VkApiException {

    /**
     * ApiAlbumsLimitException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
		parent::__construct(302, 'Albums number limit is reached', $message);
	}
}
