# GTMetrix API client for PHP

[![Packagist](https://img.shields.io/packagist/v/philcook/gtmetrix.svg)](https://packagist.org/packages/philcook/gtmetrix)
[![Packagist](https://img.shields.io/packagist/l/philcook/gtmetrix.svg)](https://packagist.org/packages/philcook/gtmetrix)

## License

Copyright (c) 2017 Opsbears

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
documentation files (the "Software"), to deal in the Software without restriction, including without limitation the
rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit
persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the
Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

## Installing

This client library can be installed using [composer](https://getcomposer.org/):

    composer require philcook/gtmetrix
    
## Using

```php
use Entrecore\GTMetrixClient\GTMetrixClient;
use Entrecore\GTMetrixClient\GTMetrixTest;

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
