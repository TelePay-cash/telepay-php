<?php

namespace TelePay;

abstract class TelePayBaseInput
{
    protected $asset;
    protected $blockchain;
    protected $network;
    protected $amount;

    public function __construct($asset, $blockchain, $network, $amount)
    {
        $this->setAsset($asset);
        $this->setBlockchain($blockchain);
        $this->setNetwork($network);
        $this->setAmount($amount);
    }

    public function getAsset()
    {
        return $this->asset;
    }
    public function setAsset($asset)
    {
        $this->asset = $asset;
    }
    public function getBlockchain()
    {
        return $this->blockchain;
    }
    public function setBlockchain($blockchain)
    {
        $this->blockchain = $blockchain;
    }
    public function getNetwork()
    {
        return $this->network;
    }
    public function setNetwork($network)
    {
        $this->network = $network;
    }
    public function getAmount()
    {
        return $this->amount;
    }
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }
}