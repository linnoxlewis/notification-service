<?php

namespace linnoxlewis\notificationService\services;

use linnoxlewis\notificationService\NotificationException;
use yii\base\Model;

/**
 * Базовый класс модели
 *
 * Class BaseClass
 *
 * @package linnoxlewis\notificationService\services
 */
Abstract class BaseClass extends Model
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
     * Get title
     *
     * @return string
     */
    public function getTitle():string
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param  string $value значение
     *
     * @return $this
     */
    public function setTitle(string $value)
    {
        $this->title = $value;
        return $this;
    }

    /**
     * Get body field
     *
     * @return string
     */
    public function getBody():string
    {
        return $this->body;
    }

    /**
     * Set body field
     *
     * @param  string $value значение
     *
     * @return $this
     */
    public function setBody($value)
    {
        $this->body = $value;
        return $this;
    }

    /**
     * Get recipients
     *
     * @return array
     */
    public function getRecipients(): array
    {
        return $this->recipients;
    }

    /**
     * Set recipients
     *
     * @param  array $value значение
     *
     * @return $this
     */
    public function setRecipients(array $value)
    {
        $this->recipients = $value;
        return $this;
    }

    /**
     * get From field
     *
     * @return string
     */
    public function getFrom():string
    {
        return $this->from;
    }

    /**
     * ser From field
     *
     * @param  string $value значение
     *
     * @return $this
     */
    public function setFrom(string  $value)
    {
        $this->from = $value;
        return $this;
    }

    /**
     * Get service secret key
     *
     * @return string
     */
    public function getSecretKey():string
    {
        return $this->secretKey;
    }

    /**
     * Set secret service key
     *
     * @param  string $value значение
     *
     * @return $this
     */
    public function setSecretKey(string $value)
    {
        $this->secretKey = $value;
        return $this;
    }

    /**
     * Method for sending message.
     *
     * @throws NotificationException
     *
     * @return array
     */
   abstract public function send():array;
}
