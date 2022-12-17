<?php

use PHPUnit\Freamwork\TestCase;
use Nasirinezhad\AzarmessageApi\Message;

class MessageTest extends TestCase
{

    public function testMessage()
    {
        $msg = new Message();
        $msg->setOneToOne();
        $msg->addReceiver('09227829074');
        $msg->message = 'Test';
        $this->assertSame(
            "<type>oto</type>\n<recipient  mobile=\"09227829074\">Test</recipient>",
            $msg->body()
        );
    }
}
