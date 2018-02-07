<?php

namespace VK\CallbackApi\Server;

use VK\CallbackApi\CallbackApiHandler;

abstract class CallbackApiServerHandler extends CallbackApiHandler {
    protected const CALLBACK_EVENT_CONFIRMATION = 'confirmation';

    protected $confirmation_token;

    public function __construct(string $confirmation_token) {
        $this->confirmation_token = $confirmation_token;
    }

    protected function confirmation(int $group_id, ?string $secret) {}

    public function parseObject(int $group_id, ?string $secret, string $type, array $object) {
        if ($type == self::CALLBACK_EVENT_CONFIRMATION) {
            $this->confirmation($group_id, $secret);
        } else {
            parent::parseObject($group_id, $secret, $type, $object);
        }
    }
}