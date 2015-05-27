<?php

use Opsbears\GTMetrixClient\GTMetrixClient;

abstract class GTMetrixTest extends PHPUnit_Framework_TestCase {
	/**
	 * @var GTMetrixClient
	 */
	protected $client;

	public function setUp() {
		$this->client = new GTMetrixClient();
		$this->client->setUsername(getenv('GTMETRIX_USERNAME'));
		$this->client->setAPIKey(getenv('GTMETRIX_APIKEY'));
	}
}