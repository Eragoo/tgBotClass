<?php 

class TelegramBot {

    private $token ;
    private $default_url = 'https://api.telegram.org/bot';
    private $errors = [];

    public function __construct($token) {
        $this->token = $token; 
    }

    public function query ($query, $params = []) {
      try{
        if($query == 'getUpdates') {
            return $this->getUpdates ($params);
        }elseif ($query == 'sendMessage') {
            return $this->sendMessage($params);
        }elseif ($query == 'getMessageParams') {
            return $this->getMessageParams($params);
        } else{
            return 'error in query';
        }
      }catch(Exception $e){
          return $e;  //$e->getMessage() . ' On line: ' . $e->getLine();
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
        $result = curl_exec($c);
        $info = curl_getinfo($c);
        if($result == false){
            throw new Exception('Exception: result = false in getUpdates() method.');
        }elseif($info['http_code'] >= 400){
            throw new Exception('Exception: http-code >= 400 in getUpdates() method.');
        }else{
            $response = json_decode($result);
            return $response;
        }
    }

    private function sendMessage ($params = []) {
        if(! isset($params['chat_id']) or ! isset($params['text'])) {
            $this->errors[] .= 'sendMessage params incorrectly';
        }else{
            $url = $this->formation_url ('sendMessage', $params);
            $s = curl_init($url);
            curl_setopt($s, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($s);
            $info = curl_getinfo($s);
            if($result == false){
                throw new Exception('Exception: result = false in sendMessage() method.');
            }elseif($info['http_code'] >= 400){
                throw new Exception('Exception: http-code >= 400 in sendMessage() method.');
            }else{
                $response = json_decode($result);
                return $response;
            }
        }

    }

    private function getMessageParams ($params = []) {
        $response = $this->getUpdates();
        if( isset($response->result[0]->message->text) ){
            $message = $response->result[0]->message->text;
        }else{
            $message = $response->result[0]->message->location;
        }
        $message_id = $response->result[0]->message->message_id;
        $chat_id = $response->result[0]->message->chat->id;
        $user_name = $response->result[0]->message->chat->first_name;
        $message_params = ['user_name' => $user_name,
                           'chat_id' => $chat_id,
                           'message' => $message,
                           'message_id' => $message_id,
                           'response' => $response];
        return $message_params;


    }

}