<?php
require_once(__DIR__ . '/TestData.php');

use VK\Client\VKApiClient;
use PHPUnit\Framework\TestCase;

final class UsersGetTest extends TestCase {
    const USER_ID_1 = '210700286';
    const USER_ID_2 = '1';

    public function testCheckResponse() {
        $users = array(static::USER_ID_2, static::USER_ID_1);
        $fields = array('city', 'photo');

        $vk = new VKApiClient();

        $response = $vk->users()->get(TestData::ACCESS_TOKEN_GROUP, array(
                'user_ids' => $users,
                'fields' => $fields
            )
        );

        $this->assertEquals($response[0]['first_name'], 'Lindsey');
        $this->assertEquals($response[0]['city']['title'], 'Los Angeles');
        $this->assertEquals($response[1]['first_name'], 'Pavel');
        $this->assertNotNull($response[1]['photo']);
    }
}