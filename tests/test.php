<?php
require_once('../src/VK/VKClient.php');
$access_token = '';

$vk = new VK\VKClient();
$response = $vk->request('users.get', array(
    'user_id' => 1,
), $access_token);
