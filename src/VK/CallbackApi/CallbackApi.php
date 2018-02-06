<?php

namespace VK\CallbackApi;

class CallbackApi extends CallbackApiHandler {
    protected const CALLBACK_EVENT_CONFIRMATION = 'confirmation';

    protected $confirmationToken;

    /**
     * CallbackApi constructor.
     * @param string $confirmationToken
     */
    public function __construct(string $confirmationToken) {
        $this->confirmationToken = $confirmationToken;
    }

    /**
     * @param int $groupId
     * @param string $token
     * @param null|string $secret
     */
    public function confirmation(int $groupId, string $token, ?string $secret) {}

    public function parseObject(int $group_id, ?string $secret, string $type, array $object) {
        if ($type == self::CALLBACK_EVENT_CONFIRMATION) {
            $this->confirmation($group_id, $this->confirmationToken, $secret);
        } else {
            parent::parseObject($group_id, $secret, $type, $object);
        }
    }
}