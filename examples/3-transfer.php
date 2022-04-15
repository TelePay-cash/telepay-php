<?php
namespace Examples;

require __DIR__ . '/../vendor/autoload.php';

use TelePay\TelePayClient;
use TelePay\TelePayEnvironment;
use TelePay\TelePayTransferInput;

$clientSecret = "YOUR SECRET";

$telepay = new TelePayClient(new TelePayEnvironment($clientSecret));

$transfer = new TelePayTransferInput("TON", "TON", "testnet", "0.2", "lugodev");
$transfer->setMessage("Debt settled");

$respTransfer= $telepay->transfer($transfer);
print_r($respTransfer);