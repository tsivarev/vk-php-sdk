<?php

namespace VK;

use VK\Exceptions\VKClientException;

/**
 * Class VKClient
 *
 * @package VK
 */
class VKClient {
    const VK_API_HOST = 'https://api.vk.com/method';
    const CONNECTION_TIMEOUT = 10;
    const VERSION_PARAM = 'v';
    const ACCESS_TOKEN_PARAM = 'access_token';
    const CONTENT_TYPE_HEADER = 'Content-Type:multipart/form-data';

    protected $api_version = '5.69';

    /**
     *
     * @param string $method
     * @param string|null $access_token
     * @param array|null $params
     *
     * @return VKResponse
     *
     * @throws VKClientException
     */
    public function request($method, $access_token, $params = array()) {
        $params[static::VERSION_PARAM] = $this->api_version;
        $params[static::ACCESS_TOKEN_PARAM] = $access_token;

        $url = static::VK_API_HOST . '/' . $method;

        return $this->sendRequest($url, array(
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
     * @param string $type
     * @param string $path
     *
     * @return VKResponse
     *
     * @throws VKClientException
     */
    public function upload($upload_url, $type, $path) {
        $payload = array();
        $payload[$type] = (class_exists('CURLFile', false)) ?
            new \CURLFile($path) : '@' . $path;

        return $this->sendRequest($upload_url, array(
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
     * @param string $url
     * @param array $options
     *
     * @return VKResponse
     *
     * @throws VKClientException
     */
    protected function sendRequest($url, $options) {
        $curl = curl_init($url);
        curl_setopt_array($curl, $options);
        $raw_response = curl_exec($curl);

        $response = new VKResponse($raw_response);

        $curl_error_code = curl_errno($curl);
        if ($curl_error_code) {
            throw new VKClientException(curl_error($curl), $curl_error_code);
        }

        curl_close($curl);

        return $response;
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
