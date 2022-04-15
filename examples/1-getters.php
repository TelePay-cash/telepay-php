<?php
namespace Examples;

require __DIR__ . '/../vendor/autoload.php';
use TelePay\TelePayClient;
use TelePay\TelePayEnvironment;


$clientSecret = "YOUR SECRET";
$environment = new TelePayEnvironment($clientSecret);

$telepay = new TelePayClient($environment);

$me = $telepay->getMe();
print_r($me);

$balance = $telepay->getBalance();
print_r($balance);

$assets = $telepay->getAssets();
print_r($assets);

$invoices = $telepay->getInvoices();
print_r($invoices);