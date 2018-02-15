<?php

namespace VK\Exceptions\Api;

class ApiCommunitiesCatalogDisabledException extends VkApiException {

    /**
     * ApiCommunitiesCatalogDisabledException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
		parent::__construct(1310, 'Catalog is not available for this user', $message);
	}
}
