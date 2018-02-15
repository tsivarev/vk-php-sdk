<?php

namespace VK\Exceptions\Api;

class ApiWallAccessRepliesException extends VkApiException {

    /**
     * ApiWallAccessRepliesException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
		parent::__construct(212, 'Access to post comments denied', $message);
	}
}
