<?php 

class TelegramBot {

    private $token = '592346368:AAdfhdKL9iyi1BegRhkt1pPC8FVvdLdMm6safbw';
    private $default_url = 'https://api.telegram.org/bot';
    private $errors = [];


    public function query ($query, $params = []) {
        if($query == 'getUpdates') {
            return $this->getUpdates ($params);
        }elseif ($query == 'sendMessage') {
            return $this->sendMessage($params);
        }else{
            foreach($errors as $error) {
                print $error . "\n";
            }
        }
    }

    private function formation_url ($query, $params = []) {
        $url = $this->default_url . $this->token . '/' . $query;
        if( ! empty($params) ){
            $url .= "?" . http_build_query($params);
        }   
        return $url;
    }
    
    private function getUpdates ($params = []) {
        $url = $this->formation_url ('getUpdates', $params);

        $c = curl_init($url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($c));
        return $response;
    }

    private function sendMessage ($params = []) {
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