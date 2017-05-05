<?php

namespace Entrecore\GTMetrixClient;

/**
 * The basic GTMetrix client class.
 *
 * Usage:
 *
 *     $client = new GTMetrixClient();
 *     $client->setUsername('your@email.com');
 *     $client->setAPIKey('your-gtmetrix-api-key');
 *
 *     $client->getLocations();
 *     $client->getBrowsers();
 *     $test = $client->startTest();
 *
 *     //Wait for result
 * 	   while ($test->getState() != GTMetrixTest::STATE_COMPLETED &&
 *         $test->getState() != GTMetrixTest::STATE_ERROR) {
 *         $client->getTestStatus($test);
 *         sleep(5);
 *     }
 *
 */
class GTMetrixClient {
	/**
	 * API endpoint. Normally you don't need to change this.
	 *
	 * @var string
	 */
	protected $endpoint = 'https://gtmetrix.com/api/0.1';

	/**
	 * GTMetrix username
	 *
	 * @var string
	 */
	protected $username = '';

	/**
	 * GTMetrix API key.
	 *
	 * @var string
	 *
	 * @see http://gtmetrix.com/api/
	 */
	protected $apiKey = '';

	/**
	 * @return string
	 */
	public function getUsername() {
		return $this->username;
	}

	/**
	 * @param string $username
	 */
	public function setUsername($username) {
		$this->username = $username;
	}

	/**
	 * @return string
	 */
	public function getAPIKey() {
		return $this->apiKey;
	}

	/**
	 * @param string $url
	 * @param array $data
	 * @param bool  $json
	 *
	 * @return array|string
	 *
	 * @throws GTMetrixConfigurationException
	 * @throws GTMetrixException
	 */
	protected function apiCall($url, $data = array(), $json = true) {
		if (!$this->username || !$this->apiKey) {
			throw new GTMetrixConfigurationException('Username and API key must be set up before using API calls!' .
				'See setUsername() and setAPIKey() for details.');
		}

		$ch = curl_init($this->endpoint . $url);
		if (!empty($data)) {
			curl_setopt($ch, CURLOPT_POST, count($data));
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		}
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->apiKey);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CAINFO, dirname(__DIR__) . '/data/ca-bundle.crt');
		$result = curl_exec($ch);
		$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$curlErrNo = curl_errno($ch);
		$curlError = curl_error($ch);
		curl_close ($ch);

		if (!\preg_match('/^(2|3)/', $statusCode)) {
			if ($statusCode == 0) {
				throw new GTMetrixException('cURL error ' . $curlErrNo . ': ' . $curlError);
			}
			throw new GTMetrixException('API error ' . $statusCode . ': ' . $result);
		}

		if ($json) {
			$data = json_decode($result, true);
			if (json_last_error()) {
				throw new GTMetrixException('Invalid JSON received: ' . json_last_error_msg());
			}
		} else {
			$data = $result;
		}

		return $data;
	}

	/**
	 * @param string $apiKey
	 */
	public function setAPIKey($apiKey) {
		$this->apiKey = $apiKey;
	}

	/**
	 * @return GTMetrixLocation[]
	 *
	 * @throws GTMetrixConfigurationException
	 */
	public function getLocations() {
		$result = $this->apiCall('/locations');

		$locations = array();
		foreach ($result as $locationData) {
			$location = new GTMetrixLocation();
			$location->fromArray($locationData);
			$locations[] = $location;
		}
		return $locations;
	}

	/**
	 * @return GTMetrixBrowser[]
	 *
	 * @throws GTMetrixConfigurationException
	 */
	public function getBrowsers() {
		$result = $this->apiCall('/browsers');

		$browsers = array();
		foreach ($result as $browserData) {
			$browser = new GTMetrixBrowser();
			$browser->fromArray($browserData);
			$browsers[] = $browser;
		}
		return $browsers;
	}

	/**
	 * @param string $id
	 *
	 * @return GTMetrixBrowser
	 * @throws GTMetrixConfigurationException
	 * @throws GTMetrixException
	 */
	public function getBrowser($id) {
		$result = $this->apiCall('/browsers/' . urlencode($id));
		$browser = new GTMetrixBrowser();
		$browser->fromArray($result);
		return $browser;
	}

	/**
	 * Start a GTMetrix test
	 *
	 * @param string $url
	 *
	 * @param null|string   $location
	 * @param null|string   $browser
	 * @param null|string   $httpUser
	 * @param null|string   $httpPassword
	 *
	 * @return GTMetrixTest
	 * @throws GTMetrixConfigurationException
	 * @throws GTMetrixException
	 */
	public function startTest($url, $location = null, $browser = null, $httpUser = null, $httpPassword = null) {

		$data = array();
		$data['url'] = $url;
		if ($location) {
			$data['location'] = $location;
		}
		if ($browser) {
			$data['browser'] = $browser;
		}
		if ($httpUser) {
			$data['login-user'] = $httpUser;
		}
		if ($httpPassword) {
			$data['login-pass'] = $httpPassword;
		}
		$result = $this->apiCall('/test', $data);

		$test = new GTMetrixTest();
		$test->setId($result['test_id']);
		$test->setPollStateUrl($result['poll_state_url']);

		return $test;
	}

	/**
	 * @param GTMetrixTest|string $test GTMetrixTest or test ID. This object will be updated
	 *
	 * @return GTMetrixTest
	 */
	public function getTestStatus($test) {
		if ($test instanceof GTMetrixTest) {
			$testId = $test->getId();
		} else {
			$testId = $test;
			$test = new GTMetrixTest();
			$test->setId($testId);
		}

		$testStatus = $this->apiCall('/test/' . urlencode($testId));
		$test->setState($testStatus['state']);
		$test->setError($testStatus['error']);
		if ($test->getState() == GTMetrixTest::STATE_COMPLETED) {
			$test->setReportUrl($testStatus['results']['report_url']);
			$test->setPagespeedScore($testStatus['results']['pagespeed_score']);
			$test->setYslowScore($testStatus['results']['yslow_score']);
			$test->setHtmlBytes($testStatus['results']['html_bytes']);
			$test->setHtmlLoadTime($testStatus['results']['html_load_time']);
			$test->setPageBytes($testStatus['results']['page_bytes']);
			$test->setPageLoadTime($testStatus['results']['page_load_time']);
			$test->setPageElements($testStatus['results']['page_elements']);
			$test->setRedirectDuration($testStatus['results']['redirect_duration']);
			$test->setConnectDuration($testStatus['results']['connect_duration']);
			$test->setBackendDuration($testStatus['results']['backend_duration']);
			$test->setFirstPaintTime($testStatus['results']['first_paint_time']);
			$test->setDomInteractiveTime($testStatus['results']['dom_interactive_time']);
			$test->setDomContentLoadedTime($testStatus['results']['dom_content_loaded_time']);
			$test->setDomContentLoadedDuration($testStatus['results']['dom_content_loaded_duration']);
			$test->setOnloadTime($testStatus['results']['onload_time']);
			$test->setOnloadDuration($testStatus['results']['onload_duration']);
			$test->setFullyLoadedTime($testStatus['results']['fully_loaded_time']);
			$test->setRumSpeedIndex($testStatus['results']['rum_speed_index']);
			$test->setResources($testStatus['resources']);
		}

		return $test;
	}
}
