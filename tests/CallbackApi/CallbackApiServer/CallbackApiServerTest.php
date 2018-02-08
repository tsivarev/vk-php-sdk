<?php

use PHPUnit\Framework\TestCase;
use VK\CallbackApi\Server\CallbackApiServerHandler;

class CallbackServer extends CallbackApiServerHandler {
    const SECRET = 'ab12aba';
    const GROUP = 123999;
    const CONFIRMATION_TOKEN = 'e67anm1';

    function confirmation(int $group_id, ?string $secret) {
        if ($secret === self::SECRET && $group_id == self::GROUP) {
            echo self::CONFIRMATION_TOKEN;
        }
    }

    public function messageNew(int $group_id, ?string $secret, array $object) {
        echo 'ok';
    }
}

class CallbackServerTest extends TestCase {
    public function testCallbackServer() {
        $my_callback_handler = new CallbackServer();
        $data = json_decode(file_get_contents('php://input'));
        $my_callback_handler->parse($data);

        $this->assertTrue(true);
    }
}
