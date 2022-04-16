<?php
namespace Examples;

require __DIR__ . '/../vendor/autoload.php';

use TelePay\TelePayClient;
use TelePay\TelePayEnvironment;
use TelePay\TelePayWithdrawInput;

$clientSecret = "YOUR SECRET";

$telepay = new TelePayClient(new TelePayEnvironment($clientSecret));

$withdraw = new TelePayWithdrawInput("TON", "TON", "mainnet", "0.2", "EQA5Pxp_EC9pTlxrvO59D1iqBqodajojullgf07ENKa22oSN");
$withdraw->setMessage("for my savings account");

$respWithdrawFee = $telepay->getWithdrawFee($withdraw);
print_r($respWithdrawFee);

if ($respWithdrawFee['total'] > 0.05) {
    throw new \Exception("the fee exceeds the limit of 0.05", 1);
}

$respWithdraw = $telepay->withdraw($withdraw);
print_r($respWithdraw);