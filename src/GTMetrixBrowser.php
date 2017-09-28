<?php


namespace Entrecore\GTMetrixClient;

/**
 * GTMetrix browser object
 */
class GTMetrixBrowser {
	/**
	 * @var string
	 */
	protected $id;

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var string
	 */
	protected $platform;

	/**
	 * @var string
	 */
	protected $device;

	/**
	 * @var string
	 */
	protected $browser;

	/**
	 * @var array
	 */
	protected $features;

	/**
	 * @return string
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param string $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getPlatform() {
		return $this->platform;
	}

	/**
	 * @param string $platform
	 */
	public function setPlatform($platform) {
		$this->platform = $platform;
	}

	/**
	 * @return string
	 */
	public function getDevice() {
		return $this->device;
	}

	/**
	 * @param string $device
	 */
	public function setDevice($device) {
		$this->device = $device;
	}

	/**
	 * @return string
	 */
	public function getBrowser() {
		return $this->browser;
	}

	/**
	 * @param string $browser
	 */
	public function setBrowser($browser) {
		$this->browser = $browser;
	}

	/**
	 * @return array
	 */
	public function getFeatures() {
		return $this->features;
	}

	/**
	 * @param array $features
	 */
	public function setFeatures($features) {
		$this->features = $features;
	}

	/**
	 * @param string $feature
	 *
	 * @return bool
	 */
	public function hasFeature($feature) {
		return (\array_search($feature, $this->features) !== false);
	}

	/**
	 * @param array $data
	 */
	public function fromArray($data) {
		$this->setId($data['id']);
		$this->setName($data['name']);
		$this->setBrowser($data['browser']);
		$this->setDevice($data['device']);

		$features = array();
		foreach ($data['features'] as $feature => $supported) {
			if ($supported) {
				$features[] = $feature;
			}
		}
		$this->setFeatures($features);
		$this->setPlatform($data['platform']);
	}

	/**
	 * @return string
	 */
	public function __toString() {
		return $this->getId();
	}

}
