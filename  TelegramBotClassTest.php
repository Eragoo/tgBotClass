<?php
 require 'TelegramBotClass.php';

 class TelegramBotTest extends \PHPUnit\Framework\TestCase {

    private $tg;

    protected function setUp() {
        $this->tg = new TelegramBot('');
    }

    protected function tearDown() {
        $this->tg = null;
    }

    public function testQuerySuccess() {
        $result = $this->tg->query('getUpdates');
        $url = 'https://api.telegram.org/bot592148368:AAEOCKL9iyi1BegRhkt1pPC8v8oLdMm68bw/getUpdates';
        $this->assertEquals( $url, $result);
    }

 }