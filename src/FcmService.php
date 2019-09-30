<?php

namespace linnoxlewis\notificationService;

use linnoxlewis\notificationService\interfaces\NotificationInterface;
use linnoxlewis\notificationService\services\Fcm;

/**
 * Class FcmService
 * @package linnoxlewis\notificationService
 */
class FcmService extends NotificationService
{
    /**
     * Method get FCM service
     *
     * @return NotificationInterface
     */
    public function getService(): NotificationInterface
    {
       return new Fcm($this->secretKey, $this->title,$this->body,$this->recipients);
    }
}
