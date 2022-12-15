<?php

namespace Nasirinezhad\AzarmessageApi;

class AzarSNS
{
    private $userid = '';
    private $password = '';
    private $action = 'smssend';

    public function __construct($user, $password) {
        $this->userid = $user;
        $this->password = $password;
    }

    public function send(Message $message)
    {
        $client = new nusoap_client($url, 'wsdl');
        $client->soap_defencoding = 'UTF-8';
        $client->decode_utf8 = true;
        $this->action = $message->action;
        $body = $message->body(); 
        $response = $client->call('XmsRequest', ['requestData'=> $this->xms($body)]);
        return new Response($response);
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
