<?php

namespace VK\Exceptions\Api;

class ApiWeightedFloodException extends VkApiException {

    /**
     * ApiWeightedFloodException constructor.
     * @param string $message
     */
    public function __construct(string $message) {
		parent::__construct(601, 'Permission denied. You have requested too many actions this day. Try later.', $message);
	}
}
