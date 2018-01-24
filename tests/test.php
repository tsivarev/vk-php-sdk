<?php
//require(dirname(getcwd()) . '/src/VK/TransportClient/CurlHttpClient.php');
////require(dirname(getcwd()) . '/src/VK/TransportClient/TransportClient.php');
////require(dirname(getcwd()) . '/src/VK/TransportClient/TransportClientResponse.php');
//require(dirname(getcwd()) . '/src/VK/VKAPIClient.php');
//require(dirname(getcwd()) . '/src/VK/VKAPIRequest.php');
require_once dirname(getcwd()) . '/src/autoload.php';

$access_token = '';

$vk = new \VK\VKAPIClient();
try {
//    $vk->wall()->post($access_token);
    $response = $vk->users()->get($access_token, array('user_ids' => '1,2'));
    var_dump($response);
} catch (\VK\Exceptions\VKClientException $e) {
    echo '1';
} catch (\VK\Exceptions\HttpRequestException $e) {
    echo '2';
} catch (\VK\Exceptions\VKAPIException $e) {
    echo '3';
}
