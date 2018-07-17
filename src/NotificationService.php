<?php

namespace notificationService;

use notificationService\interfaces\NotificationInterface;

/**
 * Class NotificationService
 * Service for sending message.
 *
 * @package app\components
 */
abstract class NotificationService
{
    abstract public function getService(): NotificationInterface;

    public function send()
    {
        $send = $this->getService();
        $send->send();
    }
}