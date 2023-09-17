<?php


namespace YallowCom\WhatsAppAPI\Messages;


interface Message {
    public static function payload(...$params): array | null;
}
