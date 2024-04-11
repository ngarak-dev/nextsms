
<p align="center">
    <img src="/art/nextsms-logo.png" width="300" title="NextSMS Logo" alt="NextSMS Logo">
</p>

# NextSMS

A Laravel package to send SMS using NextSMS API. Basically a folk from https://github.com/omakei with updated packages support for laravel 10 and 11


## Installation

You can install the package via composer:

```bash
composer require ngarak-dev/laravel-nextsms
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="nextsms-config"
```

The following keys must be available in your `.env` file:

```bash
NEXTSMS_USERNAME=
NEXTSMS_PASSWORD=
NEXTSMS_SENDER_ID=
```

This is the contents of the published `config` file:

```php
return [
    'username' => env('NEXTSMS_USERNAME', 'NEXTSMS'),
    'password' => env('NEXTSMS_PASSWORD', 'NEXTSMS'),
    'api_key' => base64_encode(env('NEXTSMS_USERNAME', 'NEXTSMS').':'.env('NEXTSMS_PASSWORD', 'NEXTSMS')),
    'sender_id' => env('NEXTSMS_SENDER_ID', 'NEXTSMS'),
    'url' => [
        'sms' => [
            'single' => NextSMS::NEXTSMS_BASE_URL.'/api/sms/v1/text/single',
            'multiple' => NextSMS::NEXTSMS_BASE_URL.'/api/sms/v1/text/multi',
            'reports' => NextSMS::NEXTSMS_BASE_URL.'/api/sms/v1/reports',
            'logs' => NextSMS::NEXTSMS_BASE_URL.'/api/sms/v1/logs',
            'balance' => NextSMS::NEXTSMS_BASE_URL.'/api/sms/v1/balance',
        ],
        'sub_customer' => [
            'create' => NextSMS::NEXTSMS_BASE_URL.'/api/reseller/v1/sub_customer/create',
            'recharge' => NextSMS::NEXTSMS_BASE_URL.'/api/reseller/v1/sub_customer/recharge',
            'deduct' => NextSMS::NEXTSMS_BASE_URL.'/api/reseller/v1/sub_customer/deduct',
        ]
    ],
];
```

## Usage

### Send SMS

#### NB: Telephone Number Must Start with Valid Country Code. Example: 2556211111111

Sending single sms to single destination:


```php

use NgarakDev\NextSMS\NextSMS;

$response = NextSMS::sendSingleSMS(['to' => '25500000000', 'text' => 'Hellooooo Next.']);

```

Sending single sms to multiple destinations:

```php

use NgarakDev\NextSMS\NextSMS;

$response = NextSMS::sendSingleSMSToMultipleDestination([
            'to' => ['255000000000','255111111111'], 
            'text' => 'Dj Helooooo.']);

```

Sending multiple sms to multiple destinations (Example 1):

```php

use NgarakDev\NextSMS\NextSMS;

$response = NextSMS::sendMultipleSMSToMultipleDestinations(['messages' => [
                ['to' => '255000000000', 'text' => 'Helooo Next.'],
                ['to' => '255111111111', 'text' => 'Helooo Next.']
            ]]);

```

Sending multiple sms to multiple destinations (Example 2):

```php

use NgarakDev\NextSMS\NextSMS;

$response = NextSMS::sendMultipleSMSToMultipleDestinations(['messages' => [
                ['to' => ['25500000000','25500000000'], 'text' => 'Heloooooooo.'],
                ['to' => '25500000000', 'text' => 'Heloooooooo.']
            ]]);

```

Schedule sms:

```php

use NgarakDev\NextSMS\NextSMS;

$response = NextSMS::scheduleSMS([
            'to' => '25500000000', 
            'text' => 'Heloooooooo.', 
            'date' => '2022-01-25' , 
            'time' => '12:00']);

```

### SMS Delivery Reports

Get all delivery reports:

```php

use NgarakDev\NextSMS\NextSMS;

$response = NextSMS::getAllDeliveryReports();

```

Get delivery reports with messageId:

```php

use NgarakDev\NextSMS\NextSMS;

$response = NextSMS::getDeliveryReportWithMessageId(243452542526627);

```

Get delivery reports with messageId:

```php

use NgarakDev\NextSMS\NextSMS;

$response = NextSMS::getDeliveryReportWithSpecificDateRange('2022-01-25', '2022-01-29');

```

### Sent Sms Logs

Get all sent SMS logs:

```php

use NgarakDev\NextSMS\NextSMS;

$response = NextSMS::getAllSentSMSLogs(10, 5);

```

Get all sent SMS logs with the optional parameter:

```php

use NgarakDev\NextSMS\NextSMS;

$response = NextSMS::getAllSentSMSLogsWithOptionalParameter('255000000000','2022-01-25', '2022-01-29',10, 5);

```

### Sub Customer

Register Sub Customer:

```php

use NgarakDev\NextSMS\NextSMS;

$response = NextSMS::subCustomerCreate(
            'Michael', 
            'Juma',
            'test@gmail.com',
            '062500000000', 
            'Sub Customer (Reseller)', 
            100);

```

Recharge customer:

```php

use NgarakDev\NextSMS\NextSMS;

$response = NextSMS::subCustomerRecharge('otest@gmail.com', 100);

```

Deduct a customer:

```php

use NgarakDev\NextSMS\NextSMS;

$response = NextSMS::subCustomerDeduct('test@gmail.com', 100);

```

Get sms balance:

```php

use NgarakDev\NextSMS\NextSMS;

$response = NextSMS::getSMSBalance();

```

## NextSMS API Documentation 

Please see [NextSMS Developer API](https://documenter.getpostman.com/view/4680389/SW7dX7JL#2936eed4-6027-45e7-92c9-fe1cd7df140b) for more details.

## Testing

```bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.