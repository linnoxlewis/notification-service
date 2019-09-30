<?php

namespace linnoxlewis\notificationService\services;

use linnoxlewis\notificationService\interfaces\NotificationInterface;
use linnoxlewis\notificationService\NotificationException;

/**
 * Class Email
 *
 * @package linnoxlewis\notificationService\services
 */
class Email extends BaseClass
{
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
}
