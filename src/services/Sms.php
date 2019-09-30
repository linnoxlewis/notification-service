<?php

namespace linnoxlewis\notificationService\services;

use linnoxlewis\notificationService\interfaces\NotificationInterface;
use linnoxlewis\notificationService\NotificationException;
use stdClass;

/**
 * Class Sms
 * @package linnoxlewis\notificationService\services
 */
class Sms extends BaseClass
{
    /**
     * protocol(http/https).
     *
     * @var string
     */
    private const PROTOCOL = 'https';

    /**
     * sms service
     *
     * @var string
     */
    private const DOMAIN = 'sms.ru';

    /**
     * Number of attempts to contact the server.
     *
     * @var string
     */
    private $countRepeat = 5;

    /**
     * Method for sending message.
     *
     * @throws NotificationException
     * @return array
     */
    public function send(): array
    {
        $data = $this->getData();
        $url = $this->getUrl();
        $request = $this->Request($url, $data);
        $response = $this->getResponse($request);
        return $response;
    }

    /**
     * setter for secret key
     *
     * @param string $secretKey secret api key
     */
    public function setSecretKey(string $secretKey) : void
    {
        $this->secretKey = $secretKey;
    }

    /**
     * Get object consist of user data.
     *
     * @return stdClass
     */
    private function getData() : stdClass
    {
        $data = new stdClass();
        $data->to = implode(",", $this->recipients);
        $data->msg = $this->title . " \r\n " . $this->body;
        return $data;
    }

    /**
     * Get url-address from sms-api.
     *
     * @return string
     */
    private function getUrl() : string
    {
        $url = self::PROTOCOL . '://' . self::DOMAIN . '/sms/send';
        return $url;
    }


    /**
     * Get response from api.
     *
     * @param string $request json-string from api
     *
     * @throws NotificationException
     * @return array
     */
    private function getResponse($request) : array
    {
        if ($request == null ) {
            throw new NotificationException("Undefined response");
        }
        $response = json_decode($request);
        return [
            "statusCode" => $response->status_code,
            "body" => $response->status . ". " . $response->status_text
        ];
    }

    /**
     * Create request to Url.
     *
     * @param string        $url url-address
     * @param bool|stdClass $post param for request
     *
     * @throws NotificationException
     * @return mixed
     */
    private function Request(string $url, $post = FALSE)
    {
        if ($post) {
            $rPost = $post;
        }
        $ch = curl_init($url . "?json=1");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

        curl_setopt($ch, CURLOPT_VERBOSE, 1);

        if (!$post) {
            $post = new stdClass();
        }

        if (!empty($post->api_id) && $post->api_id == 'none') {
        } else {
            $post->api_id = $this->secretKey;
        }

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query((array)$post));

        $body = curl_exec($ch);
        if ($body === FALSE) {
            $error = curl_error($ch);
        } else {
            $error = FALSE;
        }
        curl_close($ch);
        if ($error && $this->countRepeat > 0) {
            $this->countRepeat--;
            return $this->Request($url, $rPost);
        } elseif ($error && $this->countRepeat == 0) {
            throw new NotificationException($error);
        }
        return $body;
    }
}
