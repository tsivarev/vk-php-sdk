<?php

namespace VK\Exceptions\Api;

class ApiWeightedFloodException extends VKApiException {
    public function __construct($message) {
        parent::__construct(601,  'Permission denied. You have requested too many actions this day. Try later.',  $message);
    }
}
