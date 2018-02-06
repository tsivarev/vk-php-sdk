<?php

namespace VK\OAuth;

use VK\OAuth\Enums\OAuthResponseType;
use VK\Exceptions\HttpRequestException;
use VK\Exceptions\VKClientException;

class AuthCodeFlow extends VKOAuth {
    protected const URL_ACCESS_TOKEN = 'https://oauth.vk.com/access_token';

    protected $url_access_token;

    public function __construct(string $api_version = self::VK_API_VERSION, string $url_authorize = self::URL_AUTHORIZE,
                                string $url_access_token = self::URL_ACCESS_TOKEN) {
        $this->url_access_token = $url_access_token;
        parent::__construct($api_version, $url_authorize);
    }

    public function authorize(int $client_id, string $redirect_uri, array $group_ids = null, string $display, array $scope,
                              string $response_type = OAuthResponseType::CODE, string $state = null) {
        return parent::authorize($client_id, $redirect_uri, $group_ids, $display, $scope, $response_type, $state);
    }

    public function getAccessToken(int $client_id, string $client_secret, string $redirect_uri, string $code) {
        $params = array(
            static::API_PARAM_CLIENT_ID => $client_id,
            static::API_PARAM_CLIENT_SECRET => $client_secret,
            static::API_PARAM_REDIRECT_URI => $redirect_uri,
            static::API_PARAM_CODE => $code
        );

        try {
            $response = $this->http_client->post(static::URL_ACCESS_TOKEN, $params);
        } catch (HttpRequestException $e) {
            throw new VKClientException($e);
        }

        return $this->checkOAuthResponse($response);
    }
}