<?php

namespace linnoxlewis\notificationService\services;

use linnoxlewis\notificationService\interfaces\NotificationInterface;
use linnoxlewis\notificationService\NotificationException;
use Symfony\Component\Finder\Adapter\AbstractAdapter;

/**
 * Class Email
 * @package linnoxlewis\notificationService\services
 */
Abstract class BaseClass
{
    /**
     * message title
     *
     * @var string
     */
    protected $title = "";

    /**
     * message body
     *
     * @var string
     */
    protected $body = "";

    /**
     * to message
     *
     * @var array
     */
    protected $recipients;

    /**
     * from message
     *
     * @var string
     */
    protected $from = "example@gmail.com";

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
    public function __construct(string $secretKey, string $title, string $body,array $recipients,string $from)
    {
        $this->secretKey = $secretKey;
        $this->recipients = $recipients;
        $this->title = $title;
        $this->body = $body;
        $this->from = $from;
    }

    /**
     * Method for sending message.
     *
     * @throws NotificationException
     * @return array
     */
   abstract public function send();
}
