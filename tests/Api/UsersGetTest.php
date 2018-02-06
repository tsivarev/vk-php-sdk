<?php

use VK\Client\VKApiClient;
use PHPUnit\Framework\TestCase;

final class UsersGetTest extends TestCase {
    const USER_ID_1 = '210700286';
    const USER_ID_2 = '1';

    /**
     * @throws \VK\Exceptions\Api\VKApiException
     * @throws \VK\Exceptions\VKClientException
     */
    public function testUsersGet() {
        $users = array(static::USER_ID_1, static::USER_ID_2);
        $fields = array('city', 'photo');

        $vk = new VKApiClient();

        $response = $vk->users()->get($GLOBALS['access_token_group'], array(
                'user_ids' => $users,
                'fields' => $fields
            )
        );

        $this->assertEquals($response[0]['first_name'], 'Lindsey');
        $this->assertEquals($response[0]['city']['title'], 'Los Angeles');
        $this->assertEquals($response[1]['first_name'], 'Павел');
        $this->assertNotNull($response[1]['photo']);
    }
}
