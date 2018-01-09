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
        $curl = curl_init($url);
        curl_setopt_array($curl, array(
            CURLOPT_POST => 1,
            CURLOPT_HEADER => true,
            CURLOPT_CONNECTTIMEOUT => static::CONNECTION_TIMEOUT,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => $params
        ));
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
