<?php

namespace notificationService\interfaces;
/**
 * Interface NotificationInterface
 *
 * @package app\components\notifications\interfaces
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
