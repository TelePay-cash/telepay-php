<?php
namespace TelePay;

class TelePayEnvironment
{
    private $clientId;
    private $clientSecret;

    public function __construct($clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }
    public function getClientId()
    {
        return $this->clientId;
    }
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    public function getBaseUrl()
    {
        return "https://api.telepay.cash/rest/";
    }
}