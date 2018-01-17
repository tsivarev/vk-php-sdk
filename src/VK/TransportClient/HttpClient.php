<?php

namespace VK\TransportClient;

use VK\Exceptions\VKClientException;

/**
 * Class HttpClient
 *
 * @package VK
 */
class HttpClient {
    /**
     *
     * @param string $url
     * @param array $options
     *
     * @return \VK\VKResponse
     *
     * @throws VKClientException
     */
    public function post($url, $payload) {
        $curl = curl_init($url);
        curl_setopt_array($curl, $payload);
        $raw_response = curl_exec($curl);

        $response = new \VK\VKResponse($raw_response);

        $curl_error_code = curl_errno($curl);
        if ($curl_error_code) {
            throw new VKClientException(curl_error($curl), $curl_error_code);
        }

        curl_close($curl);

        return $response;
    }
}
