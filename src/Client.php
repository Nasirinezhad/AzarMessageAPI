<?php

namespace Nasirinezhad\AzarmessageApi;

use nusoap_client;

class Client
{
    private $client = null;
    private $response = null;
    
    public function __construct($url, $xml)
    {
        $this->client = new nusoap_client($url, 'wsdl');
        $this->client->soap_defencoding = 'UTF-8';
        $this->client->decode_utf8 = true;
        $this->response = $this->client->call('XmsRequest', ['requestData'=> $xml]);
    }

    public function __get($name)
    {
        if($name == 'client'){
            return $this->client;
        }
        return $this->response; //TODO: $response is a raw xml must be pars and return $name in $response
    }
}