<?php

namespace linnoxlewis\notificationService;

use linnoxlewis\notificationService\interfaces\NotificationInterface;

/**
 * Class NotificationService
 * Service for sending message.
 *
 * @package linnoxlewis\notificationService;
 */
abstract class NotificationService
{
    /**
     * message title
     *
     * @var string
     */
    protected $title;

    /**
     * message body
     *
     * @var string
     */
    protected $body;

    /**
     * to message
     *
     * @var array
     */
    protected $recipients;

    /**
     * Secret key
     *
     * @var string
     */
    protected $secretKey;

    /**
     * Service constructor.
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
     * Method for sending message.
     *
     * @return array
     */
    public function send()
    {
        $send = $this->getService();
        return $send->send();
    }

    /**
     * Method get Email service
     *
     * @return NotificationInterface
     */
    abstract public function getService(): NotificationInterface;
}