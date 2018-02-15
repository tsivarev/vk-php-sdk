<?php

namespace VK\Exceptions\Api;

class ApiMobileNotActivatedException extends VkApiException {

    /**
     * ApiMobileNotActivatedException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
		parent::__construct(146, 'The mobile number of the user is unknown', $message);
	}
}
