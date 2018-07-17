<?php

namespace linnoxlewis\notificationService\services;

use linnoxlewis\notificationService\interfaces\NotificationInterface;
use linnoxlewis\notificationService\NotificationException;
use Psr\Http\Message\ResponseInterface;
use sngrl\PhpFirebaseCloudMessaging\Message;
use sngrl\PhpFirebaseCloudMessaging\Notification;
use sngrl\PhpFirebaseCloudMessaging\Recipient\Device;
use sngrl\PhpFirebaseCloudMessaging\Client;

/**
 * Class Fcm
 * @package linnoxlewis\notificationService\services
 */
class Fcm implements NotificationInterface
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
     * Create and config Device instance;
     *
     * @param string $deviceToken token device from User.
     *
     * @see Device
     * @return Device
     */
    private function getDeviceInstance(string $deviceToken): Device
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

        foreach ($this->recipients as $recipient) {
            $message->addRecipient($this->getDeviceInstance($recipient));
        }

        $message->setNotification($this->getNotificationInstance());

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
        $client = new Client();
        $client->setApiKey($this->secretKey);
        $client->injectGuzzleHttpClient(new \GuzzleHttp\Client());

        return $client;
    }

    /**
     * Method for sending message.
     *
     * @throws NotificationException
     * @return array
     */
    public function send(): array
    {
        $client = $this->getClient();
        $message = $this->getMessage();
        $request = $client->send($message);
        $response = $this->getResponse($request);

        return $response;
    }


    /**
     * Get response from api.
     *
     * @param ResponseInterface $request request from api
     *
     * @throws NotificationException
     * @return array
     */
    private function getResponse(ResponseInterface $request) : array
    {
        if ($request == null )
        {
            throw new NotificationException("Undefined response");
        }
        $response = json_decode($request->getBody()->getContents());

        return [
            "statusCode" => $request->getStatusCode(),
            "body" => $response->results[0]->error
        ];
    }
}
