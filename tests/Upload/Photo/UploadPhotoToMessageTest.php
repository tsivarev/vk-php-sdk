<?php

use PHPUnit\Framework\TestCase;
use VK\Client\VKApiClient;

class UploadPhotoToMessageTest extends TestCase{
    /**
     * @throws \VK\Exceptions\Api\VKApiException
     * @throws \VK\Exceptions\VKClientException
     */
    public function testUpload() {
        $vk = new VKApiClient();

        $photo_url = $vk->photos()->getMessagesUploadServer($GLOBALS['access_token_group']);

        $photo = $vk->request()->upload($photo_url['upload_url'],
            'photo', __DIR__ . '/examp.jpg');

        $save_photo = $vk->photos()->saveMessagesPhoto($GLOBALS['access_token_group'], array(
            'server' => $photo['server'],
            'photo' => $photo['photo'],
            'hash' => $photo['hash']
        ));

        $messages_list = $vk->messages()->get($GLOBALS['access_token_group']);
        $user_id = $messages_list['items'][0]['user_id'];

        $vk->messages()->send($GLOBALS['access_token_group'], array(
            'user_id' => $user_id,
            'message' => 'Something',
        ));

        $user = $vk->users()->get($GLOBALS['access_token_group'], array(
            'user_ids' => $user_id,
        ));

        $vk->messages()->send($GLOBALS['access_token_group'], array(
            'user_id' => $user_id,
            'message' => 'Hello, ' . $user[0]['first_name'] . '!',
            'attachment' => 'photo' . $save_photo[0]['owner_id'] . '_' . $save_photo[0]['id'],
        ));

        $dialogs = $vk->messages()->getDialogs($GLOBALS['access_token_group'])['items'][0]['message'];

        $this->assertNotNull($dialogs['out']);
        $this->assertEquals($dialogs['user_id'], $user_id);
        $this->assertNotNull($dialogs['attachments']);
        $this->assertEquals($dialogs['attachments'][0]['type'], 'photo');
        $this->assertEquals($dialogs['attachments'][0]['photo']['id'], $save_photo[0]['id']);
        $this->assertEquals($dialogs['attachments'][0]['photo']['owner_id'], $save_photo[0]['owner_id']);
    }
}
