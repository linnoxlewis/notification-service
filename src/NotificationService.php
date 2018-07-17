<?php

namespace linnoxlewis\notificationService;

use linnoxlewis\notificationService\interfaces\NotificationInterface;

/**
 * Class NotificationService
 * Service for sending message.
 *
 * @package linnoxlewis\notificationService;
 */
abstract class NotificationService
{
    abstract public function getService(): NotificationInterface;

    /**
     * Method for sending message.
     *
     * @return array
     */
    public function send()
    {
        $send = $this->getService();
        return $send->send();
    }
}