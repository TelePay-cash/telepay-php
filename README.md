# PHP SDK for the TelePay API

TelePay client library for the PHP language, so you can easely process cryptocurrency payments using the REST API.

## Installation

Install the package with composer:

```bash
composer install telepay
```

## Using the library
Configure the TelePay client using the secret of your merchant
```php
$clientSecret = "YOUR SECRET";
$environment = new TelePayEnvironment($clientSecret);

$telepay = new TelePayClient($environment);
```

**Get your current merchant**
```php
$me = $telepay->getMe();
print_r($me);
```
Response
```php
Array
(
    [version] => 1.0
    [merchant] => Array
        (
            [name] => MyMerchant
            [url] => https://mymerchant.com/
            [logo_url] => https://ik.imagekit.io/telepay/merchants/descarga_-k4ehiTd5.jpeg
            [logo_thumbnail_url] => https://ik.imagekit.io/telepay/tr:n-media_library_thumbnail/merchants/descarga_-k4ehiTd5.jpeg
            [verified] => 
            [username] => merchant_username
            [public_profile] => https://telepay.cash/to/merchant_username
            [owner] => Array
                (
                    [first_name] => Raubel
                    [last_name] => Guerra
                    [username] => raubel1993
                )

            [created_at] => 2022-04-13T00:51:37.802614Z
            [updated_at] => 
        )
)
```
[Read docs](https://telepay.readme.io/reference/getme)

**Get your balance**
```php
$balance = $telepay->getBalance();
print_r($balance);
```
Response
```php
Array
(
    [wallets] => Array
        (
            [0] => Array
                (
                    [asset] => TON
                    [blockchain] => TON
                    [balance] => 10.005
                    [network] => mainnet
                )

            [1] => Array
                (
                    [asset] => TON
                    [blockchain] => TON
                    [balance] => 0
                    [network] => testnet
                )

        )

)
```
[Read docs](https://telepay.readme.io/reference/getbalance)

**Get the assets**
```php
$assets = $telepay->getAssets();
print_r($assers);
```
Response
```php
Array
(
    [assets] => Array
        (
            [0] => Array
                (
                    [asset] => TON
                    [blockchain] => TON
                    [url] => https://ton.org
                    [networks] => Array
                        (
                            [0] => mainnet
                            [1] => testnet
                        )

                )

        )

)
```
[Read docs](https://telepay.readme.io/reference/getassets)

**Create one invoice**
```php
$orderId = 56;

$invoice = new TelePayInvoiceInput("TON", "TON", "testnet", "0.2");
$invoice->setDescription("Test using SDK TelePay PHP");
$invoice->setMetadata([
    "my_reference_id" => $orderId,
    "other_metadata" => "any value"
]);
$invoice->setSuccessUrl("https://www.example.com/payment_success?order_id=$orderId");
$invoice->setCancelUrl("https://www.example.com/payment_cancelled?order_id=$orderId");

$respCreateInvoice = $telepay->createInvoice($invoice);
print_r($respCreateInvoice);
```
Response
```php
Array
(
    [number] => UIOAXSSFNB
    [asset] => TON
    [blockchain] => TON
    [network] => mainnet
    [status] => pending
    [amount] => 0.000050000000000000
    [description] => Test using SDK TelePay PHP
    [metadata] => Array
        (
            [my_reference_id] => 56
            [other_metadata] => any value
        )

    [checkout_url] => https://telepay.cash/checkout/UIOAXSSFNB
    [success_url] => https://www.example.com/payment_success?order_id=56
    [cancel_url] => https://www.example.com/payment_cancelled?order_id=56
    [explorer_url] => 
    [expires_at] => 2022-04-16T15:05:29.732789Z
    [created_at] => 2022-04-16T05:05:29.732885Z
    [updated_at] => 
)
```
[Read docs](https://telepay.readme.io/reference/createinvoice)

**View invoices**
Find many invoices. [Read docs](https://telepay.readme.io/reference/getinvoices)
```php
$invoicesResponse = $telepay->getInvoices();
```
Find one invoice by number. [Read docs](https://telepay.readme.io/reference/getinvoice)
```php
$invoiceNumber = "UIOAXSSFNB";
$respGetInvoice = $telepay->getInvoice($invoiceNumber);
```

**Cancel invoice**
```php
$invoiceNumber = "8N1DLRKV5S";
$respCancelInvoice = $telepay->cancelInvoice($invoiceNumber);
print_r($respCancelInvoice);
```
Response
```php
Array
(
    [number] => 8N1DLRKV5S
    [asset] => TON
    [blockchain] => TON
    [network] => mainnet
    [status] => cancelled
    [amount] => 0.000050000000000000
    [description] => Test using SDK TelePay PHP
    [metadata] => Array
        (
            [other_metadata] => any value
            [my_reference_id] => 56
        )

    [checkout_url] => https://telepay.cash/checkout/8N1DLRKV5S
    [success_url] => https://www.example.com/payment_success?order_id=56
    [cancel_url] => https://www.example.com/payment_cancelled?order_id=56
    [explorer_url] => 
    [expires_at] => 2022-04-17T13:08:49.524066Z
    [created_at] => 2022-04-17T03:08:49.524177Z
    [updated_at] => 2022-04-17T03:08:50.655271Z
)

```

**Delete invoice**
```php
$invoiceNumber = "8N1DLRKV5S";
$respDeleteInvoice = $telepay->deleteInvoice($invoiceNumber);
print_r($respDeleteInvoice);
```
Response
```php
Array
(
    [status] => deleted
)
```

**Transfer**
```php
$transfer = new TelePayTransferInput("TON", "TON", "mainnet", "0.00005", "raubel1993");
$transfer->setMessage("Debt settled");

$respTransfer= $telepay->transfer($transfer);
print_r($respTransfer);
```
Response
```php
Array
(
    [success] => 1
)
```
[Read docs](https://telepay.readme.io/reference/transfer)

**Withdraw and Fee**
```php
$withdraw = new TelePayWithdrawInput("TON", "TON", "mainnet", "0.2", "EQCwLtwjII1yBfO3m6T9I7__6CUXj60ZFmN3Ww2aiLQLicsO");
$withdraw->setMessage("for my savings account");

$respWithdrawFee = $telepay->getWithdrawFee($withdraw);
print_r($respWithdrawFee);
```
Response
```php
Array
(
    [blockchain_fee] => 0.001824
    [processing_fee] => 0.01
    [total] => 0.011824
)
```

```php
$respWithdraw = $telepay->withdraw($withdraw);
print_r($respWithdraw);
```

## Contributors ✨

The library is made by ([emoji key](https://allcontributors.org/docs/en/emoji-key)):

<!-- ALL-CONTRIBUTORS-LIST:START - Do not remove or modify this section -->
<!-- prettier-ignore-start -->
<!-- markdownlint-disable -->
<table>
  <tr>
    <td align="center"><a href="https://www.linkedin.com/in/raubel-guerra-l%C3%B3pez-a8024a1b0/"><img src="https://avatars.githubusercontent.com/u/49169590?v=4" width="100px;" alt=""/><br /><sub><b>Raubel Guerra</b></sub></a><br /><a href="https://github.com/TelePay-cash/telepay-php/commits?author=raubel1993" title="Code">💻</a></td>

  </tr>
</table>
<!-- markdownlint-restore -->
<!-- prettier-ignore-end -->

<!-- ALL-CONTRIBUTORS-LIST:END -->

This project follows the [all-contributors](https://github.com/all-contributors/all-contributors) specification. Contributions of any kind welcome!
