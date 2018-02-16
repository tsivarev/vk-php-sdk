<?php

namespace VK\Exceptions\Api;

class ApiAccessGroupsException extends VKApiException {
    public function __construct($message) {
        parent::__construct(260,  'Access to the groups list is denied due to the user\'s privacy settings',  $message);
    }
}
