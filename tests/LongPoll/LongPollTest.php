<?php

use PHPUnit\Framework\TestCase;
use VK\CallbackApi\Longpoll\CallbackApiLongPollExecutor;
use VK\Client\VKApiClient;

require_once(__DIR__ . '/CallbackApiMyHandler.php');

final class LongPollTest extends TestCase {
    /**
     * @throws \VK\CallbackApi\Longpoll\Exceptions\LongPollServerTsException
     * @throws \VK\Exceptions\Api\VKApiException
     * @throws \VK\Exceptions\VKClientException
     */
    public function testListen() {
        $vk = new VKApiClient();

        $vk->groups()->setLongPollSettings($GLOBALS['access_token_group'], array(
            'group_id' => $GLOBALS['group_id'],
            'enabled' => 1,
            'message_new' => 1,
            'wall_post_new' => 1,
            'group_leave' => 1,
            )
        );

        $handler = $this->getMockBuilder(CallbackApiMyHandler::class)->setMethods(['groupLeave'])->getMock();
        $handler->expects($this->once())->method('groupLeave');

        $executor = new CallbackApiLongPollExecutor($vk, $GLOBALS['access_token_group'], $GLOBALS['group_id'], $handler);

        $server = $executor->getLongPollServer();

        $vk->groups()->leave($GLOBALS['access_token_standalone'], array(
            'group_id' => $GLOBALS['group_id']));

        $executor->listen($server['ts']);

        $vk->groups()->join($GLOBALS['access_token_standalone'], array(
            'group_id' => $GLOBALS['group_id']));
    }
}
