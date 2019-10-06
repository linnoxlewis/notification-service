<?php

namespace linnoxlewis\notificationService;

/**
 * Service for sending message.
 *
 * Class NotificationService
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
     * from message
     *
     * @var string
     */
    protected $from;

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
    public function __construct(string $secretKey, string $title,
                                string $body,array $recipients,string $from)
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
     * @return array
     */
    public function send()
    {
        try {
            $send = $this->getService();
            return $send->send();
        } catch (NotificationException $exception) {
            return [
                "statusCode" => $exception->getCode(),
                "body" => $exception->getMessage()
            ];
        }
    }

    /**
     * Method get service object
     *
     * @return object
     */
    abstract public function getService();
}
