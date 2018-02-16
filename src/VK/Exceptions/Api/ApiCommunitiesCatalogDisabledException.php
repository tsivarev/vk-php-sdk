<?php

namespace VK\Exceptions\Api;

class ApiCommunitiesCatalogDisabledException extends VKApiException {
    public function __construct($message) {
        parent::__construct(1310,  'Catalog is not available for this user',  $message);
    }
}
