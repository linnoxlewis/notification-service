<?php

namespace linnoxlewis\notificationService\services;

/**
 * Email service model
 *
 * Class Email
 *
 * @package linnoxlewis\notificationService\services
 */
class Email extends BaseClass
{
    /**
     * Method for sending message.
     *
     * @return array
     */
    public function send(): array
    {
        $headers = $this->getHeader();
        foreach ($this->recipients as $recipient) {
            (mail($recipient, $this->title, $this->body, $headers));
        }
        return [
            'statusCode' => 200,
            'body' => 'success'
        ];
    }

    /**
     * Method create header for sending.
     *
     * @return string
     */
    protected function getHeader(): string
    {
        $headers = array('From: ' . $this->from,
            'Reply-To:' .  $this->from,
            'X-Mailer: PHP/' . PHP_VERSION
        );
        $headers = implode("\r\n", $headers);
        return $headers;
    }
}
