<?php

use VK\Client\VKApiClient;
use PHPUnit\Framework\TestCase;

final class UsersGetTest extends TestCase {
    const USER_ID_1 = 210700286;
    const USER_ID_2 = 1;

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

        list($user1, $user2) = $response;
        $this->assertEquals($user1['first_name'], 'Lindsey');
        $this->assertEquals($user1['city']['title'], 'Los Angeles');
        $this->assertEquals($user2['first_name'], 'Павел');
        $this->assertNotNull($user2['photo']);
    }
}
