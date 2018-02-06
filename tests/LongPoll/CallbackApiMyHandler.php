<?php

use VK\CallbackApi\CallbackApiHandler;

class CallbackApiMyHandler extends CallbackApiHandler {
    public function messageNew(int $group_id, ?string $secret, array $object) {
        var_dump($object);
    }

    public function wallPostNew(int $group_id, ?string $secret, array $object) {
        var_dump('New wall post: ' . $object['text']);
    }

    public function groupLeave(int $group_id, ?string $secret, array $object) {
        var_dump($object);
    }
}
