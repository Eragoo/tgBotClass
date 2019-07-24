<?php 

class TelegramBot {

    private $token = '592148368:AAEOCKL9iyi1BegRhkt1pPC8v8oLdMm68bw';
    private $default_url = 'https://api.telegram.org/bot';
    private $errors = [];

    private function formation_url ($query, $params = []) {
        $url = $this->default_url . $this->token . '/' . $query;
        if( ! empty($params) ){
            $url .= "?" . http_build_query($params);
        }   
        return $url;
    }
    
    public function getUpdates ($params = []) {
        $url = $this->formation_url ('getUpdates', $params);

        $c = curl_init($url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($c));
        return $response;
    }

    public function sendMessage ($params = []) {
        if(! isset($params['chat_id']) or ! isset($params['text'])) {
            $errors[] .= 'sendMessage params incorrectly';
        }else{
            $url = $this->formation_url ('sendMessage', $params);
            $s = curl_init($url);
            curl_setopt($s, CURLOPT_RETURNTRANSFER, true);
            $response = json_decode(curl_exec($s));
            return $response;
        }

    }







}