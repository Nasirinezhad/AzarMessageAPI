<?php

namespace Nasirinezhad\AzarmessageApi;

class Message
{
    private $type;
    private $receivers = [];
    private $messages = [];
    private $senddate;
    private $sendmodel;

    public $originator;
    public $doerid;
    public $message = '';
    
    public function setOneToOne()
    {
        $this->type = 'oto';
    }
    public function setOneToMany()
    {
        $this->type = 'otm';
    }

    public function addReceiver(String|Recipient $receiver, $message = null)
    {
        if($this->type == 'oto' && is_object($receiver)) {
            throw new \Exception('In One To One method you are just allowed to use phone numbers.');
        }

        $this->receivers[] = $receiver;
        if ($message) {
            $this->messages[count($this->receivers[])-1] = $message;
        }
    }
    public function newRecipient($zoneID, $total = 0)
    {
        return $this->receivers[] = new Recipient($zoneID, $total);
    }
    
    public function body()
    {
        $body = "<type>$this->type</type>\n";

        $od = '';
        if($this->originator) {
            $od = "originator = \"$this->originator\"";
        }
        if($this->doerid) {
            $od = " doerid = \"$this->doerid\"";
        }


        if($this->type == 'oto') {
            foreach ($this->receivers as $k => $v) {
                $message = isset($this->messages[$k]) ? $this->messages[$k] : $this->message;
                $body .= "<recipient $od mobile=\"$v\">$message</recipient>\n";
            }
        }else {
            $body .= "<message $od >$this->message</message>\n";
            foreach ($this->receivers as $v) {
                if (is_string($v)) {
                    $body .= "<recipient>$v</recipient>\n";
                }else {
                    $body .= '<recipient>'.$v->xml()."</recipient>\n";
                }
            }
        }
        return $body;
    }
}
