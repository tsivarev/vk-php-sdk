<?php
require(dirname(getcwd()) . '/src/VK/TransportClient/HttpClient.php');
require(dirname(getcwd()) . '/src/VK/VKResponse.php');
$access_token = '';

$vk = new \VK\VKAPIActionClient();
try {
    $vk->wall()->post($access_token);
} catch (\VK\Exceptions\VKClientException $e) {
}
