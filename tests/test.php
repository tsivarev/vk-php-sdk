<?php
require_once dirname(getcwd()) . '/vendor/autoload.php';

$access_token = '';

$vk = new \VK\VKAPIClient();
try {
    $response = $vk->users()->get($access_token, array('user_ids' => array(1, 2), 'fields' => array('city', 'sex')));
    var_dump($response);
} catch (\VK\Exceptions\VKClientException $e) {
    error_log($e);
} catch (\VK\Exceptions\VKAPIException $e) {
    error_log($e);
}
