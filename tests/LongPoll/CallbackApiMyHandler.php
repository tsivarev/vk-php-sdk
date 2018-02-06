<?php

use VK\CallbackApi\CallbackApiHandler;

class CallbackApiMyHandler extends CallbackApiHandler {
    public function groupLeave(int $group_id, ?string $secret, array $object) {
        var_dump($object);
    }
}
