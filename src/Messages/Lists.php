<?php

namespace YallowCom\WhatsAppAPI\Messages;

class Lists
{
    
    /**
     * payload
     *
     * @param  mixed $header
     * @param  mixed $body
     * @param  mixed $footer
     * @param  mixed $button
     * @param  mixed $list_parameters
     * @return array
     */
    public static function payload(string $header = '', string $body = '', string $footer = '',  string $button = '', array $list_parameters): array
    {
        $payload = [
            'type' => 'interactive',
            'interactive' => [
                'type' => 'list',
                'action' => [
                    'button' => $button
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

        if(!empty($footer)){
            $payload['interactive']['footer'] = [
                'text' => $footer
            ];   
        }

        if(!empty($list_parameters)){
            foreach ($list_parameters as $section) {
                $payload['interactive']['action']['sections'][] = [
                    'title' => $section['title'],
                    'rows' => $section['options']
                ];   
            }
        }

        return $payload;
    }

}
