<?php

namespace VK;

use VK\Exceptions\VKClientException;
use VK\TransportClient\HttpClient;

class VKAPIClient {
    const VK_API_HOST = 'https://api.vk.com/method';
    const CONNECTION_TIMEOUT = 10;
    const VERSION_PARAM = 'v';
    const ACCESS_TOKEN_PARAM = 'access_token';
    const CONTENT_TYPE_HEADER = 'Content-Type: multipart/form-data';

    protected $api_version = '5.69';
    protected $http_client;

    public function __construct() {
        $this->http_client = new HttpClient();
    }

    /**
     *
     * @param string $method
     * @param string|null $access_token
     * @param array|null $params
     *
     * @return \VK\VKResponse
     *
     * @throws VKClientException
     */
    public function request($method, $access_token, $params = array()) {
        $params[static::VERSION_PARAM] = $this->api_version;
        $params[static::ACCESS_TOKEN_PARAM] = $access_token;

        $url = static::VK_API_HOST . '/' . $method;

        return $this->http_client->post($url, array(
            CURLOPT_POST => 1,
            CURLOPT_HEADER => true,
            CURLOPT_CONNECTTIMEOUT => static::CONNECTION_TIMEOUT,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => $params
        ));
    }

    /**
     *
     * @param string $upload_url
     * @param string $parameter_name
     * @param string $path
     *
     * @return \VK\VKResponse
     *
     * @throws VKClientException
     */
    public function upload($upload_url, $parameter_name, $path) {
        $payload = array();
        $payload[$parameter_name] = (class_exists('CURLFile', false)) ?
            new \CURLFile($path) : '@' . $path;

        return $this->http_client->post($upload_url, array(
            CURLOPT_POST => 1,
            CURLOPT_HTTPHEADER => array(
                static::CONTENT_TYPE_HEADER,
            ),
            CURLOPT_HEADER => true,
            CURLOPT_CONNECTTIMEOUT => static::CONNECTION_TIMEOUT,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => $payload,
        ));
    }

    /**
     *
     * @param string
     *
     */
    public function setApiVersion($api_version) {
        $this->api_version = $api_version;
    }
}
