<?php
 require 'TelegramBotClass.php';

 class TelegramBotTest extends \PHPUnit\Framework\TestCase {

    private $tg;
    private $params = ['chat_id' => chat_id, // enter your chat_id here
                       'text' => 'test message'];

    protected function setUp() {
        $this->tg = new TelegramBot(token);
    }

    protected function tearDown() {
        $this->tg = null;
    }

    public function testQuerySuccessUpdates() {
        $result = $this->tg->query('getUpdates');
        $this->assertEquals(true, $result->ok);
    }

    public function testQuerySuccessSend() {
        $result = $this->tg->query('sendMessage', $this->params);
        $this->assertEquals(true, $result->ok);
    }

    public function testQuerySuccessGetMsg() {
        $result = $this->tg->query('getMessageParams');
        $this->assertEquals(true, $result['response']->ok);
    }

    public function testQueryExceptionUpdates() {
        $result = $this->tg->query('getUpdates');
        $this->assertEquals(true, method_exists($result, 'getMessage'));
    }


    public function testQueryExceptionSend() {
        $result = $this->tg->query('sendMessage', $this->params);
        $this->assertEquals(true, method_exists($result, 'getMessage'));
    }

    public function testQueryExceptionGetMsg() {
        $result = $this->tg->query('getMessageParams');
        $this->assertEquals(true, method_exists($result, 'getMessage'));
    }
 }