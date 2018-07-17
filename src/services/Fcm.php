<?php

namespace linnoxlewis\notificationService\services;

use linnoxlewis\notificationService\interfaces\NotificationInterface;

use sngrl\PhpFirebaseCloudMessaging\Message;
use sngrl\PhpFirebaseCloudMessaging\Notification;
use sngrl\PhpFirebaseCloudMessaging\Recipient\Device;
use sngrl\PhpFirebaseCloudMessaging\Client;

class Fcm implements NotificationInterface
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
     * user data
     *
     * @var array
     */
    public $data;

    /**
     * Create and config Device instance;
     *
     * @param string $deviceToken token device from User.
     *
     * @see Device
     * @return Device
     */
    private function getDeviceInstance($deviceToken): Device
    {
        return new Device($deviceToken);
    }

    /**
     * Create and config Notification instance.
     *
     * @return Notification
     */
    private function getNotificationInstance(): Notification
    {
        return new Notification($this->title, $this->body);
    }

    /**
     * Create and config Message instance.
     *
     * @see Message
     * @return Message
     */
    protected function getMessage(): Message
    {
        $message = new Message();
        $message->setPriority('high');

        if (empty($this->to)) {
            throw new ErrorException("no devices for the user");
        }

        foreach ($this->to as $too) {
            $message->addRecipient($this->getDeviceInstance($too));
        }

        $message
            ->setNotification($this->getNotificationInstance())
            ->setData($this->data);

        return $message;
    }

    /**
     * Create and config Client instance.
     *
     * @see Client
     * @return Client
     */
    protected function getClient(): Client
    {
        $server_key = '_YOUR_SERVER_KEY_';

        $client = new Client();
        $client->setApiKey($server_key);
        $client->injectGuzzleHttpClient(new \GuzzleHttp\Client());

        return $client;
    }

    /**
     * Method for sending message.
     *
     * @return array
     */
    public function send(): array
    {
        $client = $this->getClient();

        $message = $this->getMessage();

        $response = $client->send($message);

        $result = [
            "statusCode" => $response->getStatusCode(),
            "body" => $response->getBody()->getContents(),
        ];
        return $result;
    }
}
