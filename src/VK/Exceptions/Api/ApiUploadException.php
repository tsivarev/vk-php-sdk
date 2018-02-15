<?php

namespace VK\Exceptions\Api;

class ApiUploadException extends VkApiException {

    /**
     * ApiUploadException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
		parent::__construct(22, 'Upload error', $message);
	}
}
