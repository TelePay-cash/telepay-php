<?php

namespace TelePay;

class TelePayWithdrawInput extends TelePayBaseInput
{
    private $to_address;
    private $message;

    public function __construct($asset, $blockchain, $network, $amount, $to_address)
    {
        parent::__construct($asset, $blockchain, $network, $amount);
        $this->setToAddress($to_address);
    }
    public function getBodyPrepared()
    {
        $body = array(
            "asset" => $this->asset,
            "blockchain" => $this->blockchain,
            "network" => $this->network,
            "amount" => $this->amount,
            "to_address" => $this->to_address
        );
        if ($this->message) {
            $body["message"] = $this->message;
        }
        return $body;
    }

    public function getToAddress()
    {
        return $this->to_address;
    }
    public function setToAddress($to_address)
    {
        $this->to_address = $to_address;
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