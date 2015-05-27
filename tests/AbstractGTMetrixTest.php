<?php

use Entrecore\GTMetrixClient\GTMetrixClient;

/**
 *
 */
abstract class AbstractGTMetrixTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var GTMetrixClient
	 */
	protected $client;

	/**
	 * Set up the client from environment variables.
	 */
	public function setUp() {
		$this->client = new GTMetrixClient();
		$this->client->setUsername(getenv('GTMETRIX_USERNAME'));
		$this->client->setAPIKey(getenv('GTMETRIX_APIKEY'));
	}
}