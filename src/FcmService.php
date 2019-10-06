<?php

namespace linnoxlewis\notificationService;

use linnoxlewis\notificationService\interfaces\NotificationInterface;
use linnoxlewis\notificationService\services\Fcm;

/**
 * FCM Service
 *
 * Class FcmService
 *
 * @package linnoxlewis\notificationService
 */
class FcmService extends NotificationService
{
    /**
     * Method get FCM service
     *
     * @return Fcm
     */
    public function getService()
    {
        $model = new Fcm();
        $model->setTitle($this->title);
        $model->setSecretKey($this->secretKey);
        $model->setBody($this->body);
        $model->setRecipients($this->recipients);

        return $model;
    }
}
