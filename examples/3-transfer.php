<?php
namespace Examples;

require __DIR__ . '/../vendor/autoload.php';

use TelePay\TelePayClient;
use TelePay\TelePayException;
use TelePay\TelePayEnvironment;
use TelePay\TelePayTransferInput;

try {
    $clientSecret = "YOUR SECRET";
    $clientSecret = "secret_DAYAVCYWL8OZIAEPZHBP4ZS8U48RPD7IDXNYIQR90S0OAYGNCAL5V8V1CN5Z5Z9XDW8VREDRMQSBYPTT9CK1FABJUCRHJNYKAWGT";
    
    $telepay = new TelePayClient(new TelePayEnvironment($clientSecret));
    
    $transfer = new TelePayTransferInput("TON", "TON", "mainnet", "0.02", "raubel1993");
    $transfer->setMessage("Debt settled");
    
    $respTransfer= $telepay->transfer($transfer);
    print_r($respTransfer);
} catch (TelePayException $th) {
    print_r([
        "statusCode" => $th->getStatusCode(),
        "error" => $th->getError(),
        "message" => $th->getMessage(),
    ]);
}catch (\Throwable $th) {
    throw $th;
}