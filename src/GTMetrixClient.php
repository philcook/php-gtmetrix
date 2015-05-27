<?php

namespace Opsbears\GTMetrixClient;

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
		curl_setopt($ch, CURLOPT_CAPATH, dirname(__DIR__) . '/data/ca-bundle.crt');
		$result = curl_exec($ch);
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close ($ch);

		if (\preg_match('/^2', $status_code)) {
			throw new GTMetrixException('API error ' . $status_code . ': ' . $result);
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
	 * @return string test ID.
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
		return $result['test_id'];
	}

	public function getTestStatus() {

	}
}