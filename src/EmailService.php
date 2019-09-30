<?php

namespace linnoxlewis\notificationService;

use linnoxlewis\notificationService\interfaces\NotificationInterface;
use linnoxlewis\notificationService\services\Email;

/**
 * Class EmailService
 *
 * @package linnoxlewis\notificationService
 */
class EmailService extends NotificationService
{
    /**
     * Method get Email service
     *
     * @return NotificationInterface
     */
    public function getService(): NotificationInterface
    {
       return new Email($this->secretKey,$this->title,$this->body,$this->recipients);
    }
}
