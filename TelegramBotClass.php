<?php 

class TelegramBot {

    private $token = '592148368:AAEOCKL9iyi1BegRhkt1pPC8v8oLdMm68bw';
    private $default_url = 'https://api.telegram.org/bot';

    private function formation_url ($query, $params = []) {
        $url = $this->default_url . $this->token . '/' . $query;
        if( ! empty($params) ){
            $url .= "?" . http_build_query($params);
        }
        return $url;
    }
    
    






}