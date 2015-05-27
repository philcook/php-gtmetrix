<?php

require_once(__DIR__ . '/GTMetrixTest.php');

class GTMetrixGenericTest extends GTMetrixTest {
	public function testGetBrowsers() {
		$browsers = $this->client->getBrowsers();
		foreach ($browsers as $browser) {
			$this->assertInstanceOf('Opsbears\GTMetrixClient\GTMetrixBrowser', $browser);
		}
	}

	public function testGetLocations() {
		$locations = $this->client->getLocations();
		foreach ($locations as $location) {
			$this->assertInstanceOf('Opsbears\GTMetrixClient\GTMetrixLocation', $location);
		}
	}
}