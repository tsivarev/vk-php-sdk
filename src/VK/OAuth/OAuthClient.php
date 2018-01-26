<?php

namespace VK\OAuth;

use VK\Enums\OAuthDisplay;
use VK\Enums\OAuthGroupScope;
use VK\Enums\OAuthUserScope;
use VK\Exceptions\HttpRequestException;
use VK\Exceptions\VKClientException;
use VK\Exceptions\VKOAuthException;
use VK\TransportClient\CurlHttpClient;
use VK\TransportClient\TransportClientResponse;
use VK\VKClientBase;

class OAuthClient extends VKClientBase {
    const API_PARAM_VERSION = 'v';
    const API_PARAM_CLIENT_ID = 'client_id';
    const API_PARAM_REDIRECT_URI = 'redirect_uri';
    const API_PARAM_DISPLAY = 'display';
    const API_PARAM_SCOPE = 'scope';
    const API_PARAM_RESPONSE_TYPE = 'response_type';
    const API_PARAM_STATE = 'state';
    const API_PARAM_CLIENT_SECRET = 'client_secret';
    const API_PARAM_CODE = 'code';

    const ERROR_KEY = 'error';
    const ERROR_DESCRIPTION_KEY = 'error_description';

    const AUTHORIZE_URL = 'https://oauth.vk.com/authorize';
    const ACCESS_TOKEN_URL = 'https://oauth.vk.com/access_token';

    protected $http_client;

    public function __construct($api_version) {
        $this->http_client = new CurlHttpClient(static::CONNECTION_TIMEOUT);
        $this->api_version = $api_version;
    }

    /**
     * Opens the authorization dialog.
     *
     * @param int $client_id
     * @param string $redirect_uri
     * @param OAuthDisplay $display
     * @param OAuthUserScope[]|OAuthGroupScope[] $scope
     * @param string $state
     * @param string $response_type
     *
     * @throws VKClientException
     * @throws VKOAuthException
     */
    public function authorize($client_id, $redirect_uri, $display, $scope, $state = '', $response_type = 'code') {
        $scope_value = 0;
        foreach ($scope as $value) {
            $scope_value |= $value;
        }

        $params = array(
            static::API_PARAM_CLIENT_ID => $client_id,
            static::API_PARAM_REDIRECT_URI => $redirect_uri,
            static::API_PARAM_DISPLAY => $display,
            static::API_PARAM_SCOPE => $scope_value,
            static::API_PARAM_STATE => $state,
            static::API_PARAM_RESPONSE_TYPE => $response_type,
            static::API_PARAM_VERSION => $this->api_version
        );

        try {
            $response = $this->http_client->post(static::AUTHORIZE_URL, $params);
        } catch (HttpRequestException $e) {
            throw new VKClientException($e);
        }

        $this->checkOAuthResponse($response);
    }

    /**
     * Returns an access token.
     *
     * @param int $client_id
     * @param string $client_secret
     * @param string $redirect_uri
     * @param string $code
     *
     * @return string
     * @throws VKClientException
     * @throws VKOAuthException
     */
    public function getAccessToken($client_id, $client_secret, $redirect_uri, $code) {
        $params = array(
            static::API_PARAM_CLIENT_ID => $client_id,
            static::API_PARAM_CLIENT_SECRET => $client_secret,
            static::API_PARAM_REDIRECT_URI => $redirect_uri,
            static::API_PARAM_CODE => $code
        );

        try {
            $response = $this->http_client->post(static::ACCESS_TOKEN_URL, $params);
        } catch (HttpRequestException $e) {
            throw new VKClientException($e);
        }

        return $this->checkOAuthResponse($response);
    }

    /**
     * Decodes the authorization response and checks its status code and whether it has an error.
     *
     * @param TransportClientResponse $response
     *
     * @return mixed
     *
     * @throws VKClientException
     * @throws VKOAuthException
     */
    private function checkOAuthResponse($response) {
        $this->checkHttpStatus($response);

        $body = $response->getBody();
        $decode_body = $this->decodeBody($body);

        if ($decode_body[static::ERROR_KEY]) {
            throw new VKOAuthException($decode_body[static::ERROR_KEY], $decode_body[static::ERROR_DESCRIPTION_KEY]);
        }

        if (isset($decode_body['access_token'])) {
            return $decode_body['access_token'];
        } else {
            return $decode_body;
        }
    }
}
