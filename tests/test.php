<?php
require_once dirname(getcwd()) . '/vendor/autoload.php';
use VK\Enums\OAuthUserScope;

//$access_token = '';
//
//$vk = new \VK\VKAPIClient();
//try {
//    $response = $vk->users()->get($access_token, array('user_ids' => array(1, 2), 'fields' => array('city', 'sex')));
//    var_dump($response);
//} catch (\VK\Exceptions\VKClientException $e) {
//    error_log($e);
//} catch (\VK\Exceptions\VKAPIException $e) {
//    error_log($e);
//}

$vk = new \VK\VKAPIClient();
$vk->request()->authorization('6346414', 'http://example.com',
    'popup', array(OAuthUserScope::AUDIO, OAuthUserScope::DOCS));
//$vk->request()->getAccessToken('6346414', 'RveE23sfY9d2II1c6X0F', 'http://example.com',
//    '8474bf36bd86ca279');

//$url = 'https://oauth.vk.com/authorize';
//$curl = curl_init($url);
//
//curl_setopt_array($curl, array(
//    CURLOPT_POST => 1,
//    CURLOPT_HEADER => true,
//    CURLOPT_CONNECTTIMEOUT => 10,
//    CURLOPT_RETURNTRANSFER => true,
//    CURLOPT_POSTFIELDS => array(
//        'client_id' => '6346414',
//        'redirect_uri' => 'http://example.com',
//        'display' => 'popup',
//        'scope' => '1',
//        'response_type' => 'code',
//        'v' => '5.71',
//    )
//));
//
//$response = curl_exec($curl);
//
//var_dump($response);

//$code = '33501128d3a44300d0';
//$url = 'https://oauth.vk.com/access_token';
//$curl = curl_init($url);
//
//curl_setopt_array($curl, array(
//    CURLOPT_POST => 1,
//    CURLOPT_HEADER => true,
//    CURLOPT_CONNECTTIMEOUT => 10,
//    CURLOPT_RETURNTRANSFER => true,
//    CURLOPT_POSTFIELDS => array(
//        'client_id' => '6346414',
//        'redirect_uri' => 'example.com',
//        'client_secret' => 'RveE23sfY9d2II1c6X0F',
//        'code' => $code
//    )
//));
//
//$response = curl_exec($curl);
//
//var_dump($response);