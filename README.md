# GTMetrix API client for PHP

[![Latest Stable Version](https://poser.pugx.org/philcook/gtmetrix/v)](//packagist.org/packages/philcook/gtmetrix)
[![Build Status](https://travis-ci.org/philcook/php-gtmetrix.svg)](https://travis-ci.org/philcook/php-gtmetrix)
[![Total Downloads](https://poser.pugx.org/philcook/gtmetrix/downloads)](//packagist.org/packages/philcook/gtmetrix)
[![License](https://poser.pugx.org/philcook/gtmetrix/license)](//packagist.org/packages/philcook/gtmetrix)

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
