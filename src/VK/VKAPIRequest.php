<?php

namespace VK;

use VK\Exceptions\HttpRequestException;
use VK\Exceptions\VKApiException;
use VK\Exceptions\VKClientException;
use VK\TransportClient\CurlHttpClient;
use VK\TransportClient\TransportClientResponse;

class VKAPIRequest {
   
    protected $api_version = '5.69';
    protected $host;

    const CONNECTION_TIMEOUT = 10;
    const VERSION_PARAM = 'v';
    const ACCESS_TOKEN_PARAM = 'access_token';

    const ERROR_KEY = 'error';
    const ERROR_CODE_KEY = 'error_code';
    const ERROR_MSG_KEY = 'error_msg';

    protected $http_client;

    public function __construct($host) {
        $this->http_client = new CurlHttpClient(static::CONNECTION_TIMEOUT);
        $this->host = $host;
    }

    /**
     * Makes post request.
     *
     * @param string $method
     * @param string|null $access_token
     * @param array|null $params
     *
     * @return array
     *
     * @throws VKClientException
     * @throws VKApiException
     * @throws HttpRequestException
     */
    public function post($method, $access_token, $params = array()) {
        $params[static::VERSION_PARAM] = $this->api_version;
        $params[static::ACCESS_TOKEN_PARAM] = $access_token;

        $url = $this->host . '/' . $method;
        
        $response = $this->http_client->post($url, $params);

        return $this->checkResponse($response);
    }

    /**
     * Uploads data by its path to the given url.
     *
     * @param string $upload_url
     * @param string $parameter_name
     * @param string $path
     *
     * @return array
     *
     * @throws VKClientException
     * @throws VKApiException
     * @throws HttpRequestException
     */
    public function upload($upload_url, $parameter_name, $path) {
        $response = $this->http_client->upload($upload_url, $parameter_name, $path);

        return $this->checkResponse($response);
    }

    /**
     * Decodes the response and checks its status code and whether it has an API error.
     *
     * @param TransportClientResponse $response
     *
     * @return array
     *
     * @throws VKApiException
     * @throws HttpRequestException
     */
    private function checkResponse($response) {
        if ($response->getHttpStatus() != 200) {
            throw new HttpRequestException();
        }

        $body = $response->getBody();
        $decode_body = $this->decodeBody($body);

        if ($decode_body[static::ERROR_KEY]) {
            throw new VKApiException($decode_body[static::ERROR_KEY][static::ERROR_CODE_KEY],
                $decode_body[static::ERROR_KEY][static::ERROR_MSG_KEY]);
        }

        return $decode_body['response'];
    }

    /**
     * Decodes body.
     *
     * @param string
     *
     * @return array
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
