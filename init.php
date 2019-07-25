<?php

include "TelegramBotClass.php";

$tg = new TelegramBot('');
$update_id;
//while(true){
    //sleep(2);
    $response = $tg->query('getUpdates', ['offset'=>$update_id + 1]);
    var_dump($response->result[0]->message->location);
    exit();
    
    if(!empty($response->result)){
        $update_id = $response->result[count($response->result) - 1]->update_id;
    }
  
    $chat_id = $response->result[0]->message->chat->id;
    $message_id = $response->result[0]->message->message_id;
    $text = 'lol';

    $params = [
        'chat_id' => $chat_id,
        'text' => $text,
        'reply_to_message_id' => $message_id,
    ];

    $tg->query('sendMessage', $params);


//}


