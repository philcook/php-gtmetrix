<?php

use LightningStudio\GTMetrixClient\GTMetrixTest;

require_once(__DIR__ . '/AbstractGTMetrixTest.php');

/**
 * Functional test for the GTMetrix client.
 */
class GTMetrixFunctionalTest extends AbstractGTMetrixTest {
	public function testGetBrowsers() {
		$browsers = $this->client->getBrowsers();
		foreach ($browsers as $browser) {
			$this->assertInstanceOf('LightningStudio\GTMetrixClient\GTMetrixBrowser', $browser);
		}
	}

	public function testGetLocations() {
		$locations = $this->client->getLocations();
		foreach ($locations as $location) {
			$this->assertInstanceOf('LightningStudio\GTMetrixClient\GTMetrixLocation', $location);
		}
	}

	public function testStart() {
		$test = $this->client->startTest('https://www.wikipedia.org/');
		$this->assertNotEmpty($test->getId());
		while ($test->getState() != GTMetrixTest::STATE_COMPLETED &&
			$test->getState() != GTMetrixTest::STATE_ERROR) {
			$this->client->getTestStatus($test);
			sleep(5);
		}
	}
}
