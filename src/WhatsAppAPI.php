<?php

namespace YallowCom\WhatsAppAPI;

use YallowCom\WhatsAppAPI\Exceptions\TypeException;
use YallowCom\WhatsAppAPI\Exceptions\ConfigurationException;

class WhatsAppAPI
{
    const ENV_WHATSAPP_BASE_URL = 'WHATSAPP_BASE_URL';
    const ENV_WHATSAPP_API_VER = 'WHATSAPP_API_VER';
    const ENV_WHATSAPP_PHONE_NUMBER_ID = 'WHATSAPP_PHONE_NUMBER_ID';
    const ENV_WHATSAPP_PERMANENT_ACCESS_TOKEN = 'WHATSAPP_PERMANENT_ACCESS_TOKEN';

    protected $accessToken;
    protected $baseURL;
    protected $APIVer;
    protected $phoneNumberId;

    public function __construct() 
    {
        self::checkConfigrutions();
    }

    /**
     * Send WhatsApp message
     *
     * @param  mixed $to recipient phone number
     * @param  mixed $type (text|template|buttons|lists) 
     * @param  mixed $params 
     * @return void
     */
    public function send(string $to, string $type, ...$params): array
    {   
        $messageClass = 'YallowCom\WhatsAppAPI\Messages\\' . ucwords($type);
        if(!class_exists($messageClass))
            throw new TypeException("Message type of ($type) is not supported");

        $payload = $messageClass::payload(...$params);
        $payload['to'] = $to;
        $url = self::buildURL('messages');

        $response = self::performRequest('POST', $url, $payload);
        
        return $response;
    }

    private function checkConfigrutions(): bool
    {
        if(!getenv(self::ENV_WHATSAPP_BASE_URL)) throw new ConfigurationException("Missing env variable (WHATSAPP_BASE_URL)");
        if(!getenv(self::ENV_WHATSAPP_API_VER)) throw new ConfigurationException("Missing env variable (WHATSAPP_API_VER)");
        if(!getenv(self::ENV_WHATSAPP_PHONE_NUMBER_ID)) throw new ConfigurationException("Missing env variable (WHATSAPP_PHONE_NUMBER_ID)");
        if(!getenv(self::ENV_WHATSAPP_PERMANENT_ACCESS_TOKEN)) throw new ConfigurationException("Missing env variable (WHATSAPP_PERMANENT_ACCESS_TOKEN)");

        $this->baseURL = getenv(self::ENV_WHATSAPP_BASE_URL);
        $this->APIVer = getenv(self::ENV_WHATSAPP_API_VER);
        $this->phoneNumberId = getenv(self::ENV_WHATSAPP_PHONE_NUMBER_ID);
        $this->accessToken = getenv(self::ENV_WHATSAPP_PERMANENT_ACCESS_TOKEN);

        return true;
    }

    private function buildURL(string $endpoint) : string 
    {
        $base_url = rtrim($this->baseURL, '/');
        $$endpoint = ltrim($endpoint, '/');
        $$endpoint = rtrim($endpoint, '/');

        $url = implode('/', [$base_url, $this->APIVer, $this->phoneNumberId, $endpoint]);

        return $url;
    }

    private function performRequest(string $method = 'POST', string $url, array $payload): array
    {
        $body = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual'
        ];

        $body = array_merge($body, $payload);
        $body = json_encode($body);

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => $method,
          CURLOPT_POSTFIELDS => $body,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->accessToken
          ),
        ));
 
        $response = json_decode(curl_exec($curl), true);
        curl_close($curl);

        return $response;
    }
}
