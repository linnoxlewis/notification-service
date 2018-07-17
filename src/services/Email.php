<?php

namespace linnoxlewis\notificationService\services;

use linnoxlewis\notificationService\interfaces\NotificationInterface;
use linnoxlewis\notificationService\NotificationException;

/**
 * Class Email
 * @package linnoxlewis\notificationService\services
 */
class Email implements NotificationInterface
{
    /**
     * message title
     *
     * @var string
     */
    private $title = "";
    /**
     * message body
     *
     * @var string
     */
    private $body = "";
    /**
     * to message
     *
     * @var array
     */
    private $recipients;
    /**
     * from message
     *
     * @var string
     */
    private $from = "example@gmail.com";

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
     * Method create header for sending.
     *
     * @return string
     */
    private function getHeader() : string
    {
        $headers = array("From: " . $this->from,
            "Reply-To: replyto@example.com",
            "X-Mailer: PHP/" . PHP_VERSION
        );
        $headers = implode("\r\n", $headers);

        return $headers;
    }

    /**
     * Method for sending message.
     *
     * @throws NotificationException
     * @return array
     */
    public function send(): array
    {
        $headers = $this->getHeader();
        $result = [];
        foreach ($this->recipients as $recipient) {
            if (mail($recipient, $this->title, $this->body, $headers))
            {
                $result = [
                    "statusCode" => 200,
                    "body" => "succsess"
                ];
            } else {
                throw new NotificationException("sending failed");
            }
        }
        return $result;
    }
}
