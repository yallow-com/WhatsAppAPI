<?php

namespace YallowCom\WhatsAppAPI\Messages;

class Template
{
    
    /**
     * payload
     *
     * @param  mixed $name
     * @param  mixed $header_parameters
     * @param  mixed $body_parameters
     * @param  mixed $buttons_parameters
     * @param  mixed $language
     * @return array
     */
    public static function payload(string $name, array $header_parameters = [],  array $body_parameters = [],  array $buttons_parameters = [], string $language = 'en_US'): array
    {
        $payload = [
            'type' => 'template',
            'template' => [
                'name' => $name,
                'language' => [
                    'code' => $language ?? 'en_US'
                ]
            ]
        ]; 

        if(!empty($header_parameters)){
            $payload['template']['components'][] = [
                'type' => 'header',
                'parameters' => $header_parameters
            ];
        }

        if(!empty($body_parameters)){
            $payload['template']['components'][] = [
                'type' => 'body',
                'parameters' => $body_parameters
            ];
        }

        if(!empty($buttons_parameters)){
            foreach ($buttons_parameters as $key => $button) {
                $payload['template']['components'][] = [
                    'type' => 'button',
                    'sub_type' => "quick_reply",
                    'index' => $key,
                    'parameters' => [
                        'type' => 'payload',
                        'payload' => $button
                    ]
                ];   
            }
        }

        return $payload;
    }

}
