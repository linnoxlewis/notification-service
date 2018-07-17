<?php

namespace linnoxlewis\notificationService\interfaces;
/**
 * Interface NotificationInterface
 *
 * @package linnoxlewis\notificationService\interfaces
 */
interface NotificationInterface
{
    /**
     * Method for sending message.
     *
     * @return array
     */
    public function send(): array ;
}
