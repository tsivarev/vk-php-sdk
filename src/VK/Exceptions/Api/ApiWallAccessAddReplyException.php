<?php

namespace VK\Exceptions\Api;

class ApiWallAccessAddReplyException extends VkApiException {

    /**
     * ApiWallAccessAddReplyException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
		parent::__construct(213, 'Access to status replies denied', $message);
	}
}
