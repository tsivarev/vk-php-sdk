<?php

namespace VK\CallbackApi\Server;

use VK\CallbackApi\CallbackApiHandler;

abstract class CallbackApiServerHandler extends CallbackApiHandler {
    protected const EVENT_KEY_TYPE = 'type';
    protected const EVENT_KEY_OBJECT = 'object';
    protected const EVENT_KEY_SECRET = 'secret';
    protected const EVENT_KEY_GROUP_ID = 'group_id';

    protected const CALLBACK_EVENT_CONFIRMATION = 'confirmation';

    /**
     * @param int $group_id
     * @param null|string $secret
     * @return mixed
     */
    abstract function confirmation(int $group_id, ?string $secret);

    /**
     * @param array $event
     */
    public function parse(array $event) {
        if ($event->type == self::CALLBACK_EVENT_CONFIRMATION) {
            $this->confirmation($event->group_id, $event->secret);
        } else {
            parent::parseObject($event->group_id, $event->secret, $event->type, $event->object);
        }
    }
}