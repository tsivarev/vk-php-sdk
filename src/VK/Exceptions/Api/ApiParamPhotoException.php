<?php

namespace VK\Exceptions\Api;

class ApiParamPhotoException extends VkApiException {

    /**
     * ApiParamPhotoException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
		parent::__construct(129, 'Invalid photo', $message);
	}
}
