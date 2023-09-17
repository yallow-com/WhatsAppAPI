<?php

namespace YallowCom\WhatsAppAPI\Messages;

class Text
{
    
    /**
     * payload
     *
     * @param  mixed $body
     * @return array
     */
    public static function payload(string $body = ''): array
    {
        $payload = [
            'type' => 'text',
            'text' => [
                'preview_url' => false,
                'body' => $body
            ]
        ]; 

        return $payload;
    }

}
