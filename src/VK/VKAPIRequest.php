<?php

namespace VK;

use VK\Exceptions\HttpRequestException;
use VK\Exceptions\VKApiException;
use VK\Exceptions\VKClientException;
use VK\Exceptions\VKOAuthException;
use VK\TransportClient\CurlHttpClient;
use VK\TransportClient\TransportClientResponse;

class VKAPIRequest {
    const API_PARAM_VERSION = 'v';
    const API_PARAM_ACCESS_TOKEN = 'access_token';
    const API_PARAM_CLIENT_ID = 'client_id';
    const API_PARAM_REDIRECT_URI = 'redirect_uri';
    const API_PARAM_DISPLAY = 'display';
    const API_PARAM_SCOPE = 'scope';
    const API_PARAM_RESPONSE_TYPE = 'response_type';
    const API_PARAM_STATE = 'state';
    const API_PARAM_CLIENT_SECRET = 'client_secret';
    const API_PARAM_CODE = 'code';

    const CONNECTION_TIMEOUT = 10;
    const HTTP_STATUS_CODE_OK = 200;

    const RESPONSE_TYPE_API = 0;
    const RESPONSE_TYPE_OAUTH = 1;

    const ERROR_KEY = 'error';
    const ERROR_CODE_KEY = 'error_code';
    const ERROR_MSG_KEY = 'error_msg';
    const ERROR_DESCRIPTION_KEY = 'error_description';

    protected $http_client;
    protected $host;
    protected $api_version;

    public function __construct($host, $api_version) {
        $this->http_client = new CurlHttpClient(static::CONNECTION_TIMEOUT);
        $this->host = $host;
        $this->api_version = $api_version;
    }

    /**
     * Makes post request.
     *
     * @param string $method
     * @param string|null $access_token
     * @param array|null $params
     *
     * @return mixed
     *
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKOAuthException
     */
    public function post($method, $access_token, $params = array()) {
        $params = $this->formatParams($params);
        $params[static::API_PARAM_VERSION] = $this->api_version;
        $params[static::API_PARAM_ACCESS_TOKEN] = $access_token;

        $url = $this->host . '/' . $method;

        try {
            $response = $this->http_client->post($url, $params);
        } catch (HttpRequestException $e) {
            throw new VKClientException($e);
        }

        return $this->checkResponse($response);
    }

    /**
     * Uploads data by its path to the given url.
     *
     * @param string $upload_url
     * @param string $parameter_name
     * @param string $path
     *
     * @return mixed
     *
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKOAuthException
     */
    public function upload($upload_url, $parameter_name, $path) {
        try {
            $response = $this->http_client->upload($upload_url, $parameter_name, $path);
        } catch (HttpRequestException $e) {
            throw new VKClientException($e);
        }

        return $this->checkResponse($response);
    }

    /**
     * Redirects user's browser to the given URI and opens the authorization dialog.
     *
     * @param $client_id
     * @param $redirect_uri
     * @param $display
     * @param $scope
     * @param string $state
     * @param string $response_type
     *
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKOAuthException
     */
    public function authorization($client_id, $redirect_uri, $display, $scope, $state = '', $response_type = 'code') {
        $params = array(
            static::API_PARAM_CLIENT_ID => $client_id,
            static::API_PARAM_REDIRECT_URI => $redirect_uri,
            static::API_PARAM_DISPLAY => $display,
            static::API_PARAM_SCOPE => $scope,
            static::API_PARAM_STATE => $state,
            static::API_PARAM_RESPONSE_TYPE => $response_type,
            static::API_PARAM_VERSION => $this->api_version
        );

        $url = 'https://oauth.vk.com/authorize';

        try {
            $response = $this->http_client->post($url, $params);
        } catch (HttpRequestException $e) {
            throw new VKClientException($e);
        }

        $this->checkResponse($response, static::RESPONSE_TYPE_OAUTH);
    }

    /**
     * @param $client_id
     * @param $client_secret
     * @param $redirect_uri
     * @param $code
     *
     * @return string
     * @throws VKClientException
     * @throws VKApiException
     * @throws VKOAuthException
     */
    public function getAccessToken($client_id, $client_secret, $redirect_uri, $code) {
        $params = array(
            static::API_PARAM_CLIENT_ID => $client_id,
            static::API_PARAM_CLIENT_SECRET => $client_secret,
            static::API_PARAM_REDIRECT_URI => $redirect_uri,
            static::API_PARAM_CODE => $code
        );

        $url = 'https://oauth.vk.com/access_token';

        try {
            $response = $this->http_client->post($url, $params);
        } catch (HttpRequestException $e) {
            throw new VKClientException($e);
        }

        return $this->checkResponse($response, static::RESPONSE_TYPE_OAUTH);
    }

    /**
     * Decodes the response and checks its status code and whether it has an API error. Returns decoded response.
     *
     * @param TransportClientResponse $response
     *
     * @return mixed
     *
     * @throws VKApiException
     * @throws VKClientException
     * @throws VKOAuthException
     */
    private function checkResponse($response, $type = 0) {
        $this->checkHttpStatus($response);

        $body = $response->getBody();
        $decode_body = $this->decodeBody($body);

        if ($decode_body[static::ERROR_KEY]) {
            switch ($type) {
                case static::RESPONSE_TYPE_API:
                    throw new VKApiException($decode_body[static::ERROR_KEY][static::ERROR_CODE_KEY],
                        $decode_body[static::ERROR_KEY][static::ERROR_MSG_KEY]);
                case static::RESPONSE_TYPE_OAUTH:
                    throw new VKOAuthException($decode_body[static::ERROR_KEY],
                        $decode_body[static::ERROR_DESCRIPTION_KEY]);
            }
        }

        switch ($type) {
            case static::RESPONSE_TYPE_API:
                return $decode_body['response'];
                break;
            case static::RESPONSE_TYPE_OAUTH:
                if (isset($decode_body['access_token'])) {
                    return $decode_body['access_token'];
                }
                break;
        }
    }

    /**
     * @param TransportClientResponse $response
     *
     * @throws VKClientException
     */
    private function checkHttpStatus($response) {
        if ($response->getHttpStatus() != static::HTTP_STATUS_CODE_OK) {
            throw new VKClientException("Invalid http status: {$response->getHttpStatus()}");
        }
    }

    /**
     * Formats given array of parameters for making the request.
     *
     * @param array $params
     *
     * @return array
     */
    private function formatParams($params) {
        foreach ($params as $key => $value) {
            if (is_array($value)) {
                $params[$key] = implode(', ', $value);
            }
        }
        return $params;
    }

    /**
     * Decodes body.
     *
     * @param string
     *
     * @return mixed
     */
    private function decodeBody($body) {
        $decoded_body = json_decode($body, true);

        if ($decoded_body === null || !is_array($decoded_body)) {
            $decoded_body = [];
        }

        return $decoded_body;
    }

    /**
     * Sets API version.
     *
     * @param string
     */
    public function setApiVersion($api_version) {
        $this->api_version = $api_version;
    }
}
