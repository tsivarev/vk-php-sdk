<?php

namespace VK\CallbackApi;

class CallbackApi extends CallbackApiHandler {
    protected const CALLBACK_EVENT_CONFIRMATION = 'confirmation';

    protected $confirmation_token;

    /**
     * CallbackApi constructor.
     * @param string $confirmation_token
     */
    public function __construct(string $confirmation_token) {
        $this->confirmation_token = $confirmation_token;
    }

    /**
     * @param int $group_id
     * @param string $token
     * @param null|string $secret
     */
    protected function confirmation(int $group_id, string $token, ?string $secret) {}

    public function parseObject(int $group_id, ?string $secret, string $type, array $object) {
        if ($type == self::CALLBACK_EVENT_CONFIRMATION) {
            $this->confirmation($group_id, $this->confirmation_token, $secret);
        } else {
            parent::parseObject($group_id, $secret, $type, $object);
        }
    }
}