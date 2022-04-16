<?php
namespace TelePay;

/**
 * This  exception represent a exception of TelePay.
 */
class TelePayException extends \Exception
{
    public function getName()
    {
        return 'TelePay Exception';
    }
}