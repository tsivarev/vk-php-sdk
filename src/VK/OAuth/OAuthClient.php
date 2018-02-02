<?php

namespace VK\OAuth;

use VK\OAuth\Enums\OAuthDisplay;
use VK\OAuth\Enums\OAuthGroupScope;
use VK\OAuth\Enums\OAuthResponseType;
use VK\OAuth\Enums\OAuthUserScope;
use VK\Exceptions\HttpRequestException;
use VK\Exceptions\VKClientException;
use VK\Exceptions\VKOAuthException;
use VK\TransportClient\CurlHttpClient;
use VK\TransportClient\TransportClientResponse;

class OAuthClient {
    protected const API_PARAM_VERSION = 'v';
    protected const API_PARAM_CLIENT_ID = 'client_id';
    protected const API_PARAM_REDIRECT_URI = 'redirect_uri';
    protected const API_PARAM_DISPLAY = 'display';
    protected const API_PARAM_SCOPE = 'scope';
    protected const API_PARAM_RESPONSE_TYPE = 'response_type';
    protected const API_PARAM_STATE = 'state';
    protected const API_PARAM_CLIENT_SECRET = 'client_secret';
    protected const API_PARAM_CODE = 'code';

    protected const ERROR_KEY = 'error';
    protected const ERROR_DESCRIPTION_KEY = 'error_description';

    protected const AUTHORIZE_URL = 'https://oauth.vk.com/authorize';
    protected const ACCESS_TOKEN_URL = 'https://oauth.vk.com/access_token';

    protected const CONNECTION_TIMEOUT = 10;
    protected const HTTP_STATUS_CODE_OK = 200;

    protected $http_client;
    protected $api_version;

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
     * @param OAuthResponseType $response_type
     * @param string $state
     *
     * @throws VKClientException
     * @throws VKOAuthException
     */
    public function authorize(int $client_id, string $redirect_uri, string $display, array $scope,
                              string $response_type = OAuthResponseType::CODE, ?string $state = null) {
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
    public function getAccessToken(int $client_id, string $client_secret, string $redirect_uri, string $code) {
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
    private function checkOAuthResponse(TransportClientResponse $response) {
        $this->checkHttpStatus($response);

        $body = $response->getBody();
        $decode_body = $this->decodeBody($body);

        if ($decode_body[static::ERROR_KEY]) {
            throw new VKOAuthException("{$decode_body[static::ERROR_DESCRIPTION_KEY]}. OAuth error {$decode_body[static::ERROR_KEY]}");
        }

        if (isset($decode_body['access_token'])) {
            return $decode_body['access_token'];
        } else {
            return $decode_body;
        }
    }

    /**
     * Decodes body.
     *
     * @param string $body
     *
     * @return mixed
     */
    protected function decodeBody(string $body) {
        $decoded_body = json_decode($body, true);

        if ($decoded_body === null || !is_array($decoded_body)) {
            $decoded_body = [];
        }

        return $decoded_body;
    }

    /**
     * @param TransportClientResponse $response
     *
     * @throws VKClientException
     */
    protected function checkHttpStatus(TransportClientResponse $response) {
        if ($response->getHttpStatus() != static::HTTP_STATUS_CODE_OK) {
            throw new VKClientException("Invalid http status: {$response->getHttpStatus()}");
        }
    }
}
