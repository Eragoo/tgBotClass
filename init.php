<?php
//file wtf?
include "TelegramBotClass.php";




 $tg = new TelegramBot('tg_token');
 $res = $tg->query('getUpdates'); 


