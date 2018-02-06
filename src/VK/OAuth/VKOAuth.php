<?php

namespace VK\OAuth;

use VK\Exceptions\HttpRequestException;
use VK\Exceptions\VKClientException;
use VK\Exceptions\VKOAuthException;
use VK\OAuth\Enums\OAuthAuthorizeMethod;
use VK\OAuth\Enums\OAuthResponseType;
use VK\TransportClient\CurlHttpClient;
use VK\TransportClient\TransportClientResponse;

class VKOAuth {
    protected const VK_API_VERSION = '5.69';

    protected const API_PARAM_VERSION = 'v';
    protected const API_PARAM_CLIENT_ID = 'client_id';
    protected const API_PARAM_REDIRECT_URI = 'redirect_uri';
    protected const API_PARAM_GROUP_IDS = 'group_ids';
    protected const API_PARAM_DISPLAY = 'display';
    protected const API_PARAM_SCOPE = 'scope';
    protected const API_PARAM_RESPONSE_TYPE = 'response_type';
    protected const API_PARAM_STATE = 'state';
    protected const API_PARAM_CLIENT_SECRET = 'client_secret';
    protected const API_PARAM_CODE = 'code';
    protected const API_PARAM_REVOKE = 'revoke';

    protected const KEY_ERROR = 'error';
    protected const KEY_ERROR_DESCRIPTION = 'error_description';
    protected const KEY_ACCESS_TOKEN = 'access_token';

    protected const URL_AUTHORIZE = 'https://oauth.vk.com/authorize';
    protected const URL_ACCESS_TOKEN = 'https://oauth.vk.com/access_token';

    protected const CONNECTION_TIMEOUT = 10;
    protected const HTTP_STATUS_CODE_OK = 200;

    protected $http_client;
    protected $api_version;
    protected $url_authorize;
    protected $url_access_token;

    /**
     * VKOAuth constructor.
     *
     * @param string $api_version
     * @param string $url_authorize
     * @param string $url_access_token
     */
    public function __construct($api_version = self::VK_API_VERSION, $url_authorize = self::URL_AUTHORIZE,
                                $url_access_token = self::URL_ACCESS_TOKEN) {
        $this->http_client = new CurlHttpClient(static::CONNECTION_TIMEOUT);
        $this->api_version = $api_version;
        $this->url_authorize = $url_authorize;
        $this->url_access_token = $url_access_token;
    }

    /**
     * Opens the authorization dialog.
     *
     * @param int $authorize_method
     * @param int $client_id
     * @param string $redirect_uri
     * @param array|null $group_ids
     * @param string $display
     * @param array $scope
     * @param string|null $state
     * @param int $revoke_auth
     * @return mixed
     *
     * @throws VKClientException
     * @throws VKOAuthException
     */
    public function authorize(int $authorize_method = OAuthAuthorizeMethod::AUTHORIZATION_CODE, int $client_id, string $redirect_uri,
                              array $group_ids = null, string $display, array $scope, string $state = null, int $revoke_auth = 0) {
        $scope_value = 0;
        foreach ($scope as $value) {
            $scope_value |= $value;
        }

        $response_type = null;
        if ($authorize_method == OAuthAuthorizeMethod::AUTHORIZATION_CODE) {
            $response_type = OAuthResponseType::CODE;
        } else if($authorize_method == OAuthAuthorizeMethod::IMPLICIT) {
            $response_type = OAuthResponseType::TOKEN;
        }

        $params = array(
            static::API_PARAM_CLIENT_ID => $client_id,
            static::API_PARAM_REDIRECT_URI => $redirect_uri,
            static::API_PARAM_GROUP_IDS => join(',', $group_ids),
            static::API_PARAM_DISPLAY => $display,
            static::API_PARAM_SCOPE => $scope_value,
            static::API_PARAM_STATE => $state,
            static::API_PARAM_RESPONSE_TYPE => $response_type,
            static::API_PARAM_VERSION => $this->api_version
        );

        if ($revoke_auth) {
            $params[static::API_PARAM_REVOKE] = $revoke_auth;
        }

        try {
            $response = $this->http_client->post(static::URL_AUTHORIZE, $params);
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
    protected function checkOAuthResponse(TransportClientResponse $response) {
        $this->checkHttpStatus($response);

        $body = $response->getBody();
        $decode_body = $this->decodeBody($body);

        if (isset($decode_body[static::KEY_ERROR])) {
            throw new VKOAuthException("{$decode_body[static::KEY_ERROR_DESCRIPTION]}. OAuth error {$decode_body[static::KEY_ERROR]}");
        }

        if (isset($decode_body[static::KEY_ACCESS_TOKEN])) {
            return $decode_body[static::KEY_ACCESS_TOKEN];
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
