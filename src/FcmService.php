<?php

namespace notificationService\notifications;

use notificationService\interfaces\NotificationInterface;
use notificationService\NotificationService;
use notificationService\services\Fcm;

class FcmService extends NotificationService
{
    /**
     * message title
     *
     * @var string
     */
    private $title;
    /**
     * message body
     *
     * @var string
     */
    private $body;
    /**
     * to message
     *
     * @var array
     */
    private $to;

    public function __construct($title,$body,$to)
    {
        $this->to = $to;
        $this->title = $title;
        $this->body = $body;
    }

    /**
     * Method get FCM service
     *
     * @return NotificationInterface
     */
    public function getService(): NotificationInterface
    {
       return new Fcm( $this->title,$this->body, $this->to);
    }
}
