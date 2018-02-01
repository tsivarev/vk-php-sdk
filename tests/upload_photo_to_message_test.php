<?php
require_once dirname(getcwd()) . '/src/autoload.php';
//require_once 'autoload.php';
use VK\Client\VKApiClient;
use VK\CallbackApiHandlerTest;

$vk = new VKApiClient();

$access_token = '9375094dedec1d1589a50628fef275090fe0aaeae807638b93e10f52cc30bc679a311249897f9b349f27f';

//$path = '/Users/Viktoria/Documents/Work/VK/vk-php-sdk/tests/examp.jpg';
//$parameter_name = 'photo';

//$payload = array();
//$payload[$parameter_name] = (class_exists('CURLFile', false)) ?
//    new \CURLFile($path) : '@' . $path;
//
//$curl = curl_init($response_get_photo_url['upload_url']);
//
//curl_setopt_array($curl, array(
//    CURLOPT_HEADER => true,
//    CURLOPT_CONNECTTIMEOUT => 10,
//    CURLOPT_RETURNTRANSFER => true,
//    CURLOPT_POST => 1,
//    CURLOPT_HTTPHEADER => array(
//        'Content-Type: multipart/form-data'
//    ),
//    CURLOPT_POSTFIELDS => $payload
//));
//
//$response = curl_exec($curl);
//var_dump($response);


$response_get_photo_url = $vk->photos()->getMessagesUploadServer($access_token);

$response_photo = $vk->request()->upload($response_get_photo_url['upload_url'],
        'photo', '/Users/Viktoria/Documents/Work/VK/vk-php-sdk/tests/examp.jpg');

$response_save_photo = $vk->photos()->saveMessagesPhoto($access_token, array(
    'server' => $response_photo['server'],
    'photo' => $response_photo['photo'],
    'hash' => $response_photo['hash']
));

var_dump($response_save_photo);

$send_message = function($value) {
    global $vk;
    global $access_token;
    global $response_save_photo;
    $user_id = $value['user_id'];

    $response_user = $vk->users()->get($access_token, array(
        'user_ids' => $user_id,
    ));

    $response_message_send = $vk->messages()->send($access_token, array(
        'user_id' => $user_id,
        'message' => 'Привет, ' . $response_user[0]['first_name'] . '!',
        'attachment' => 'photo' . $response_save_photo[0]['owner_id'] . '_' . $response_save_photo[0]['id'],
    ));
};

$response_messages_list = $vk->messages()->get($access_token);

array_map($send_message, $response_messages_list['items']);

//$access_token = 'e29f1ca5128abd868a5203e46bb0a1b12d18c07b60d4abbd953effb803ae8b41744073a9457b598cde53a';
//var_dump($access_token);
//$vk->wall()->post($access_token, array(
//    'owner_id' => -159895463,
//    'from_group' => '1',
//    'attachment' => 'photo' . $response_save_photo['owner_id'] . '_' . $response_save_photo['id'],
//));
