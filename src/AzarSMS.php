<?php

namespace Nasirinezhad\AzarmessageApi;

class AzarSMS
{
    private $userid = '';
    private $password = '';
    private $action = 'smssend';
    private $url = 'http://8.8.8.8/ws/sms.asmx?WSDL';

    public function __construct($user, $password, $url = null) {
        $this->userid = $user;
        $this->password = $password;
        if($url) {
            $this->url = $url;
        }
    }

    public function sendSMS(Message $message)
    {
        $this->action = 'smssend';
        $body = $message->body();
        $client = new Client($this->url, $this->xms($body));
        return $client;
    }

    public function bankNumber($id = 0)
    {
        $this->action = 'treenodes';
        $body = $this->xms('<node id="'.$id.'" />');
        $client = new Client($this->url, $body);
        return $client;

    }


    private function xms($body)
    {
        return "<xmsrequest>\n".
                "<userid>$this->userid</userid>\n".
                "<password>$this->password</password>\n".
                "<action>$this->action</action>\n".
                "<body>\n$body</body>\n".
                '</xmsrequest>';
    }
}
