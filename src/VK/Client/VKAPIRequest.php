<?php

namespace VK\Client;

use VK\Exceptions\HttpRequestException;
use VK\Exceptions\VKApiException;
use VK\Exceptions\VKClientException;
use VK\TransportClient\CurlHttpClient;
use VK\TransportClient\TransportClientResponse;

class VKAPIRequest extends VKClientBase {
    const API_PARAM_VERSION = 'v';
    const API_PARAM_ACCESS_TOKEN = 'access_token';

    const ERROR_KEY = 'error';
    const ERROR_CODE_KEY = 'error_code';
    const ERROR_MSG_KEY = 'error_msg';
    const ERROR_DESCRIPTION_KEY = 'error_description';
    const RESPONSE_KEY = 'response';

    protected $host;

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
     * Decodes the response and checks its status code and whether it has an API error. Returns decoded response.
     *
     * @param TransportClientResponse $response
     *
     * @return mixed
     *
     * @throws VKApiException
     * @throws VKClientException
     */
    private function checkResponse($response) {
        $this->checkHttpStatus($response);

        $body = $response->getBody();
        $decode_body = $this->decodeBody($body);

        if ($decode_body[static::ERROR_KEY]) {
            $error_msg = $decode_body[static::ERROR_KEY][static::ERROR_MSG_KEY];
            $error_code = $decode_body[static::ERROR_KEY][static::ERROR_CODE_KEY];
            throw new VKApiException("API error {$error_code}: {$error_msg}");
        }

        if (isset($decode_body[static::RESPONSE_KEY])) {
            return $decode_body[static::RESPONSE_KEY];
        } else {
            return $decode_body;
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
                $params[$key] = implode(',', $value);
            }
        }
        return $params;
    }
}
