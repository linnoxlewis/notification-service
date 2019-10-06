<?php

namespace linnoxlewis\notificationService;

use linnoxlewis\notificationService\services\Email;

/**
 * Email service
 *
 * Class EmailService
 *
 * @package linnoxlewis\notificationService
 */
class EmailService extends NotificationService
{
    /**
     * Method get Email service
     *
     * @return Email
     */
    public function getService()
    {
        $model = new Email();
        $model->setTitle($this->title);
        $model->setSecretKey($this->secretKey);
        $model->setBody($this->body);
        $model->setRecipients($this->recipients);
        $model->setFrom($this->from);

        return $model;
    }
}
