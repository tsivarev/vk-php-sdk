<?php

namespace VK\Exceptions\Api;

class ApiAdsPermissionException extends VKApiException {
    /**
     * ApiAdsPermissionException constructor.
     * @param string $message
     **/
    public function __construct(string $message) {
        parent::__construct(600,  'Permission denied. You have no access to operations specified with given object(s)',  $message);
    }
}
