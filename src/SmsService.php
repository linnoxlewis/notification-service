<?php

namespace linnoxlewis\notificationService;

use linnoxlewis\notificationService\services\Sms;

/**
 * Sms service
 *
 * Class SmsService
 *
 * @package linnoxlewis\notificationService
 */
class SmsService extends NotificationService
{
    /**
     * Method get sms service
     *
     * @return Sms
     */
    public function getService()
    {
        $model = new Sms();
        $model->setTitle($this->title);
        $model->setSecretKey($this->secretKey);
        $model->setBody($this->body);
        $model->setRecipients($this->recipients);

        return $model;
    }
}
