<?php
require(dirname(getcwd()) . '/src/VK/VKClient.php');
require(dirname(getcwd()) . '/src/VK/VKResponse.php');
$access_token = '';

$vk = new VK\VKClient();
try {
    $response = $vk->request('users.get', $access_token, array(
        'user_id' => 1,
    ));

    var_dump($response);
} catch (\VK\Exceptions\VKClientException $e) {

}
