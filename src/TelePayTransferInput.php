<?php

namespace TelePay;

class TelePayTransferInput extends TelePayBaseInput
{
    private $username;
    private $message;

    public function __construct($asset, $blockchain, $network, $amount, $username)
    {
        parent::__construct($asset, $blockchain, $network, $amount);
        $this->setUsername($username);
    }
    public function getBodyPrepared()
    {
        $body = array(
            "asset" => $this->asset,
            "blockchain" => $this->blockchain,
            "network" => $this->network,
            "amount" => $this->amount,
            "username" => $this->username
        );
        if ($this->message) {
            $body["message"] = $this->message;
        }
        return $body;
    }

    public function getUserName()
    {
        return $this->username;
    }
    public function setUserName($username)
    {
        $this->username = $username;
    }
    public function getMessage()
    {
        return $this->message;
    }
    public function setMessage($message)
    {
        $this->message = $message;
    }
}