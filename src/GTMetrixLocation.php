<?php


namespace Entrecore\GTMetrixClient;

/**
 * GTMetrix location object.
 */
class GTMetrixLocation {
	/**
	 * @var string
	 */
	protected $id;
	/**
	 * @var string
	 */
	protected $name;
	/**
	 * @var bool
	 */
	protected $default = false;

	/**
	 * @var int[]
	 */
	protected $browserIds = array();

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
	 * @return boolean
	 */
	public function isDefault() {
		return $this->default;
	}

	/**
	 * @param boolean $default
	 */
	public function setDefault($default) {
		$this->default = $default;
	}

	/**
	 * @return string[]
	 */
	public function getBrowserIds() {
		return $this->browserIds;
	}

	/**
	 * @param string[] $browserIds
	 */
	public function setBrowserIds($browserIds) {
		$this->browserIds = $browserIds;
	}

	/**
	 * @param array $data
	 */
	public function fromArray($data) {
		$this->setId($data['id']);
		$this->setName($data['name']);
		$this->setDefault($data['default']);
		$this->setBrowserIds($data['browsers']);
	}

	/**
	 * @return string
	 */
	public function __toString() {
		return $this->getId();
	}
}