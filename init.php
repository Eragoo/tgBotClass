<?php

include "TelegramBotClass.php";

$tg = new TelegramBot;
$response = $tg->getUpdates();
$chat_id = $response->result[0]->message->chat->id;
$params = [
    'chat_id' => $chat_id,
    'text' => 'kek',
];

$tg->sendMessage($params);


