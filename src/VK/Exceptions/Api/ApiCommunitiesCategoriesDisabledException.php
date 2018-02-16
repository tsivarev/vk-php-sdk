<?php

namespace VK\Exceptions\Api;

class ApiCommunitiesCategoriesDisabledException extends VKApiException {
    public function __construct($message) {
        parent::__construct(1311,  'Catalog categories are not available for this user',  $message);
    }
}
