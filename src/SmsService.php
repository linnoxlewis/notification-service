<?php

namespace linnoxlewis\notificationService;

use linnoxlewis\notificationService\interfaces\NotificationInterface;
use linnoxlewis\notificationService\services\Sms;

/**
 * Class SmsService
 * @package linnoxlewis\notificationService
 */
class SmsService extends NotificationService
{
    /**
     * Method get FCM service
     *
     * @return NotificationInterface
     */
    public function getService(): NotificationInterface
    {
       return new Sms($this->secretKey,$this->title,$this->body,$this->recipients);
    }
}
