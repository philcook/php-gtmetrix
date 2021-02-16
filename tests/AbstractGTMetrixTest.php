<?php

use Entrecore\GTMetrixClient\GTMetrixClient;
use PHPUnit\Framework\TestCase;

/**
 *
 */
abstract class AbstractGTMetrixTest extends TestCase
{
	/**
	 * @var GTMetrixClient
	 */
	protected $client;

	/**
	 * Set up the client from environment variables.
	 */

    protected function setUp(): void {
        parent::setUp();
        $this->client = new GTMetrixClient();
        $this->client->setUsername(getenv('GTMETRIX_USERNAME'));
        $this->client->setAPIKey(getenv('GTMETRIX_APIKEY'));
    }
}
