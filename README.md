# GTMetrix API client for PHP

[![Packagist](https://img.shields.io/packagist/v/philcook/gtmetrix.svg)](https://packagist.org/packages/philcook/gtmetrix)
[![Packagist](https://img.shields.io/packagist/l/philcook/gtmetrix.svg)](https://packagist.org/packages/philcook/gtmetrix)

## Installing

This client library can be installed using [composer](https://getcomposer.org/):

    composer require philcook/gtmetrix
    
## Using

```php
use LightningStudio\GTMetrixClient\GTMetrixClient;
use LightningStudio\GTMetrixClient\GTMetrixTest;

$client = new GTMetrixClient();
$client->setUsername('your@email.com');
$client->setAPIKey('your-gtmetrix-api-key');

$client->getLocations();
$client->getBrowsers();
$test = $client->startTest('http://www.example.com/');
 
//Wait for result
while ($test->getState() != GTMetrixTest::STATE_COMPLETED &&
    $test->getState() != GTMetrixTest::STATE_ERROR) {
    $client->getTestStatus($test);
    sleep(5);
}
```

## Update information

From version 2.0 references to Entrecore have been replace with LightningStudio due to Entrecore no longer existing and therefore avoiding confusion for users. 
