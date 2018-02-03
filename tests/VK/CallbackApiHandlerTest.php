<?php

namespace VK;

use VK\CallbackApi\CallbackApiHandler;

class CallbackApiHandlerTest extends CallbackApiHandler {
    public function messageNew(int $group_id, ?string $secret, array $object) {
        var_dump($object);
    }

    public function wallPostNew(int $group_id, ?string $secret, array $object) {
        var_dump('New wall post: ' . $object['text']);
    }
}
