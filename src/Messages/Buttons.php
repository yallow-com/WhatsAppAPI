<?php

namespace YallowCom\WhatsAppAPI\Messages;

class Buttons
{
    
    /**
     * payload
     *
     * @param  mixed $header
     * @param  mixed $body
     * @param  mixed $buttons_parameters
     * @return array
     */
    public static function payload(string $header = '', string $body = '', array $buttons_parameters): array
    {
        $payload = [
            'type' => 'interactive',
            'interactive' => [
                'type' => 'button',
                'action' => [
                    'buttons' => []
                ]
            ]
        ]; 

        if(!empty($header)){
            $payload['interactive']['header'] = [
                'type' => 'text',
                'text' => $header
            ];   
        }

        if(!empty($body)){
            $payload['interactive']['body'] = [
                'text' => $body
            ];   
        }

        if(!empty($buttons_parameters)){
            foreach ($buttons_parameters as $key => $button) {
                $payload['interactive']['action']['buttons'][] = [
                    'type' => 'reply',
                    'reply' => $button
                ];   
            }
        }

        return $payload;
    }

}
