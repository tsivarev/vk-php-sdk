<?php

namespace VK\OAuth;

use VK\OAuth\Enums\OAuthResponseType;

class ImplicitFlow extends VKOAuth {
    public function __construct(string $api_version = self::VK_API_VERSION, string $url_authorize = self::URL_AUTHORIZE,
                                int $revoke_auth = 0) {
        parent::__construct($api_version, $url_authorize, $revoke_auth);
    }

    public function authorize(int $client_id, string $redirect_uri, array $group_ids = null, string $display, array $scope,
                              string $response_type = OAuthResponseType::TOKEN, string $state = null) {
        return parent::authorize($client_id, $redirect_uri, $group_ids, $display, $scope, $response_type, $state);
    }
}