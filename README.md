# PHP SDK for the TelePay API

![TelePay PHP](https://github.com/TelePay-cash/telepay-php/blob/main/docs/cover.jpg?raw=true)

TelePay client library for the PHP language, so you can easely process cryptocurrency payments using the REST API.

[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](https://opensource.org/licenses/MIT)
[![Last commit](https://img.shields.io/github/last-commit/telepay-cash/telepay-php.svg?style=flat-square)](https://github.com/telepay-cash/telepay-php/commits)
[![GitHub commit activity](https://img.shields.io/github/commit-activity/m/telepay-cash/telepay-php?style=flat-square)](https://github.com/telepay-cash/telepay-php/commits)
[![Github Stars](https://img.shields.io/github/stars/telepay-cash/telepay-php?style=flat-square&logo=github&)](https://github.com/telepay-cash/telepay-php/stargazers)
[![Github Forks](https://img.shields.io/github/forks/telepay-cash/telepay-php?style=flat-square&logo=github)](https://github.com/telepay-cash/telepay-php/network/members)
[![Github Watchers](https://img.shields.io/github/watchers/telepay-cash/telepay-php?style=flat-square&logo=github)](https://github.com/telepay-cash/telepay-php)
[![GitHub contributors](https://img.shields.io/github/contributors/telepay-cash/telepay-php?label=code%20contributors&style=flat-square)](https://github.com/telepay-cash/telepay-php/graphs/contributors)
[![Telegram](https://img.shields.io/badge/Telegram-2CA5E0?style=flat-squeare&logo=telegram&logoColor=white)](https://t.me/TelePayCash)
[![Blog](https://img.shields.io/badge/RSS-FFA500?style=flat-square&logo=rss&logoColor=white)](https://blog.telepay.cash)

## Installation

Install the package with composer:

```bash
composer require telepaycash/sdk-telepay-php
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
    [number] => O5ZOJ15JXU
    [asset] => TON
    [blockchain] => TON
    [network] => mainnet
    [status] => pending
    [amount] => 0.500000000000000000
    [description] => Test using SDK TelePay PHP
    [metadata] => Array
        (
            [my_reference_id] => 56
            [other_metadata] => any value
        )

    [checkout_url] => https://telepay.cash/checkout/O5ZOJ15JXU
    [onchain_url] => ton://transfer/EQA5Pxp_EC9pTlxrvO59D1iqBqodajojullgf07ENKa22oSN?amount=500000000&text=O5ZOJ15JXU
    [success_url] => https://www.example.com/payment_success?order_id=56
    [cancel_url] => https://www.example.com/payment_cancelled?order_id=56
    [explorer_url] => 
    [expires_at] => 2022-05-19T08:43:38.802833Z
    [created_at] => 2022-05-18T22:43:38.802925Z
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
    [number] => O5ZOJ15JXU
    [asset] => TON
    [blockchain] => TON
    [network] => mainnet
    [status] => pending
    [amount] => 0.500000000000000000
    [description] => Test using SDK TelePay PHP
    [metadata] => Array
        (
            [my_reference_id] => 56
            [other_metadata] => any value
        )

    [checkout_url] => https://telepay.cash/checkout/O5ZOJ15JXU
    [onchain_url] => ton://transfer/EQA5Pxp_EC9pTlxrvO59D1iqBqodajojullgf07ENKa22oSN?amount=500000000&text=O5ZOJ15JXU
    [success_url] => https://www.example.com/payment_success?order_id=56
    [cancel_url] => https://www.example.com/payment_cancelled?order_id=56
    [explorer_url] => 
    [expires_at] => 2022-05-19T08:43:38.802833Z
    [created_at] => 2022-05-18T22:43:38.802925Z
    [updated_at] => 
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

**Withdraw minimum**
```php
$withdrawMinimum = new TelePayWithdrawMinimumInput("TON", "TON", "mainnet");

$respWithdrawMinimum = $telepay->getWithdrawFee($withdrawMinimum);
print_r($respWithdrawMinimum);
```
Response
```php
Array
(
    [withdraw_minimum] => 0.2
)
```


**Withdraw Fee**
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

**Withdraw**
```php
$withdraw = new TelePayWithdrawInput("TON", "TON", "mainnet", "0.2", "EQCwLtwjII1yBfO3m6T9I7__6CUXj60ZFmN3Ww2aiLQLicsO");
$withdraw->setMessage("for my savings account");

$respWithdraw = $telepay->withdraw($withdraw);
print_r($respWithdraw);
```
Response
```php
Array
(
    [success] => 1
)
```

## Tests
All endpoint responses were tested.
To run the tests yourself, you need your TelePay merchant secret with at least 3 testnet toncoins, a Telepay user who will receive the test transfer, and a testnet wallet who will receive the test withdraw.
```bash
TELEPAY_SECRET= USERNAME_TELEPAY_TRANSFER= WHITDRAW_TO_WALLET=  composer tests
```

## Contributors ✨

The library is made by ([emoji key](https://allcontributors.org/docs/en/emoji-key)):

<!-- ALL-CONTRIBUTORS-LIST:START - Do not remove or modify this section -->
<!-- prettier-ignore-start -->
<!-- markdownlint-disable -->
<table>
  <tr>
    <td align="center"><a href="https://www.linkedin.com/in/raubel-guerra-l%C3%B3pez-a8024a1b0/"><img src="https://avatars.githubusercontent.com/u/49169590?v=4" width="100px;" alt=""/><br /><sub><b>Raubel Guerra</b></sub></a><br /><a href="https://github.com/TelePay-cash/telepay-php/commits?author=raubel1993" title="Code">💻</a></td>
    <td align="center"><a href="https://lugodev.com"><img src="https://avatars.githubusercontent.com/u/18733370?v=4?s=100" width="100px;" alt=""/><br /><sub><b>Carlos Lugones</b></sub></a><br /><a href="https://github.com/telepay-cash/telepay-node/commits?author=lugodev" title="Mentoring">🧑‍🏫</a></td>
  </tr>
</table>
<!-- markdownlint-restore -->
<!-- prettier-ignore-end -->

<!-- ALL-CONTRIBUTORS-LIST:END -->

This project follows the [all-contributors](https://github.com/all-contributors/all-contributors) specification. Contributions of any kind welcome!
