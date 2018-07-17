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
     * recipients message
     *
     * @var array
     */
    private $recipients;

    /**
     * Secret key
     *
     * @var string
     */
    private $secretKey;

    /**
     * SmsService constructor.
     * @param string $secretKey
     * @param string $title
     * @param string $body
     * @param array  $recipients
     */
    public function __construct(string $secretKey, string $title, string $body,array $recipients)
    {
        $this->secretKey = $secretKey;
        $this->recipients = $recipients;
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
       return new Fcm($this->secretKey, $this->title,$this->body,$this->recipients);
    }
}
