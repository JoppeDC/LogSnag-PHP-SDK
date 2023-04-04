<div align="center">
  <a href="https://logsnag.com/?utm_source=github/joppedc-logsnag-php-sdk&utm_medium=logo" target="_blank">
    <img src="https://logsnag.com/_next/static/media/logo-text.c9e33f2c.svg" alt="LogSnag" width="280" height="84">
  </a>
<p><i>Realtime monitoring, for your entire business. A <a href="https://logsnag.com/?utm_source=github/joppedc-logsnag-php-sdk&utm_medium=logo" target="_blank">LogSnag</a> PHP SDK. </i></p>
</div>

<p align="center">
  <a href="https://packagist.org/packages/joppedc/logsnag-php-sdk"><img src="https://img.shields.io/packagist/v/joppedc/logsnag-php-sdk" alt="Latest Stable Version"></a>
  <a href="https://github.com/JoppeDC/LogSnag-PHP-SDK/actions"><img src="https://github.com/JoppeDC/LogSnag-PHP-SDK/workflows/CI/badge.svg" alt="Test"></a>
  <a href="https://github.com/JoppeDC/LogSnag-PHP-SDK/blob/main/LICENSE"><img src="https://img.shields.io/badge/license-MIT-informational" alt="License"></a>
</p>

# Unofficial PHP SDK

## Getting started

### Install

To install the SDK you will need to be using [Composer]([https://getcomposer.org/)
in your project. To install it please see the [docs](https://getcomposer.org/download/).

This is the "core" SDK, meaning that all the core logic and models are here.
If you are happy with using the HTTP client we recommend install the SDK
like: [`joppedc/logsnag-php-sdk`](https://github.com/JoppeDC/LogSnag-PHP-SDK)

```bash
composer require joppedc/logsnag-php-sdk
```

This package (`joppedc/logsnag-php-sdk`) is not tied to any specific library that sends HTTP messages. Instead,
it uses [Httplug](https://github.com/php-http/httplug) to let users choose whichever
PSR-7 implementation and HTTP client they want to use.

If you just want to get started quickly you should run the following command:

```bash
composer require joppedc/logsnag-php-sdk php-http/curl-client
```

This will install the library itself along with an HTTP client adapter that uses
cURL as transport method (provided by Httplug). You do not have to use those
packages if you do not want to. The SDK does not care about which transport method
you want to use because it's an implementation detail of your application. You may
use any package that
provides [`php-http/async-client-implementation`](https://packagist.org/providers/php-http/async-client-implementation)
and [`http-message-implementation`](https://packagist.org/providers/psr/http-message-implementation).

### Configuration

```php
new JoppeDc\LogsnagPhpSdk\Client("https://api.logsnag.com/v1/", "your_secret_key");
```

### Usage


#### Create new log event

```php
$payload = new JoppeDc\LogsnagPhpSdk\Contracts\LogPayload(
    'project_name',
    'channel_name',
    'event_name'
);

$payload->setDescription('test-description');
$payload->setTags(['tag' => 'tag value']);
$payload->setIcon('😀');

$log = $this->client->createLog($payload);
```

#### Create new insight event

```php
$payload = new JoppeDc\LogsnagPhpSdk\Contracts\InsightPayload(
    'project_name',
    'title',
    5
);

$payload->setIcon('😀');

$insight = $this->client->createLog($payload);
```

#### Mutate an insight event

```php
$payload = new JoppeDc\LogsnagPhpSdk\Contracts\MutateInsightPayload(
    'project_name',
    'title',
    -5
);

$payload->setIcon('😀');

$insight = $this->client->createLog($payload);
```

## Special thanks

- [Logsnag](https://docs.logsnag.com)