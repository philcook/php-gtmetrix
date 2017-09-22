<?php


namespace Entrecore\GTMetrixClient;

/**
 * GTMetrix test object
 */
class GTMetrixTest {
	const STATE_QUEUED    = 'queued';
	const STATE_STARTED   = 'started';
	const STATE_COMPLETED = 'completed';
	const STATE_ERROR     = 'error';

	/**
	 * @var string
	 */
	protected $id;

	/**
	 * @var string
	 */
	protected $pollStateUrl;

	/**
	 * @var string
	 * @see self::STATE_*
	 */
	protected $state;

	/**
	 * @var string
	 */
	protected $error;

	/**
	 * @var string
	 */
	protected $reportUrl;

	/**
	 * @var int
	 */
	protected $pagespeedScore;

	/**
	 * @var int
	 */
	protected $yslowScore;

	/**
	 * @var int
	 */
	protected $htmlBytes;

	/**
	 * @var int
	 */
	protected $htmlLoadTime;

	/**
	 * @var int
	 */
	protected $pageBytes;

	/**
	 * @var int
	 */
	protected $pageLoadTime;

	/**
	 * @var int
	 */
	protected $pageElements;

    /**
     * @var int
     */
    protected $redirectDuration;

    /**
     * @var int
     */
    protected $connectDuration;

    /**
     * @var int
     */
    protected $backendDuration;

    /**
     * @var int
     */
    protected $firstPaintTime;

    /**
     * @var int
     */
    protected $domInteractiveTime;

    /**
     * @var int
     */
    protected $domContentLoadedTime;

    /**
     * @var int
     */
    protected $domContentLoadedDuration;

    /**
     * @var int
     */
    protected $onloadTime;

    /**
     * @var int
     */
    protected $onloadDuration;

    /**
     * @var int
     */
    protected $fullyLoadedTime;

    /**
     * @var int
     */
    protected $rumSpeedIndex;

	/**
	 * Links to more resources available
	 *
	 * @var array
	 */
	protected $resources = array();

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
	public function getPollStateUrl() {
		return $this->pollStateUrl;
	}

	/**
	 * @param string $pollStateUrl
	 */
	public function setPollStateUrl($pollStateUrl) {
		$this->pollStateUrl = $pollStateUrl;
	}

	/**
	 * @return string
	 */
	public function getState() {
		return $this->state;
	}

	/**
	 * @param string $state
	 */
	public function setState($state) {
		$this->state = $state;
	}

	/**
	 * @return string
	 */
	public function getError() {
		return $this->error;
	}

	/**
	 * @param string $error
	 */
	public function setError($error) {
		$this->error = $error;
	}

	/**
	 * @return string
	 */
	public function getReportUrl() {
		return $this->reportUrl;
	}

	/**
	 * @param string $reportUrl
	 */
	public function setReportUrl($reportUrl) {
		$this->reportUrl = $reportUrl;
	}

	/**
	 * @return int
	 */
	public function getPagespeedScore() {
		return $this->pagespeedScore;
	}

	/**
	 * @param int $pagespeedScore
	 */
	public function setPagespeedScore($pagespeedScore) {
		$this->pagespeedScore = $pagespeedScore;
	}

	/**
	 * @return int
	 */
	public function getYslowScore() {
		return $this->yslowScore;
	}

	/**
	 * @param int $yslowScore
	 */
	public function setYslowScore($yslowScore) {
		$this->yslowScore = $yslowScore;
	}

	/**
	 * @return int
	 */
	public function getHtmlBytes() {
		return $this->htmlBytes;
	}

	/**
	 * @param int $htmlBytes
	 */
	public function setHtmlBytes($htmlBytes) {
		$this->htmlBytes = $htmlBytes;
	}

	/**
	 * @return int
	 */
	public function getHtmlLoadTime() {
		return $this->htmlLoadTime;
	}

	/**
	 * @param int $htmlLoadTime
	 */
	public function setHtmlLoadTime($htmlLoadTime) {
		$this->htmlLoadTime = $htmlLoadTime;
	}

	/**
	 * @return int
	 */
	public function getPageBytes() {
		return $this->pageBytes;
	}

	/**
	 * @param int $pageBytes
	 */
	public function setPageBytes($pageBytes) {
		$this->pageBytes = $pageBytes;
	}

	/**
	 * @return int
	 */
	public function getPageLoadTime() {
		return $this->pageLoadTime;
	}

	/**
	 * @param int $pageLoadTime
	 */
	public function setPageLoadTime($pageLoadTime) {
		$this->pageLoadTime = $pageLoadTime;
	}

	/**
	 * @return int
	 */
	public function getPageElements() {
		return $this->pageElements;
	}

	/**
	 * @param int $pageElements
	 */
	public function setPageElements($pageElements) {
		$this->pageElements = $pageElements;
	}

    /**
     * @return int
     */
    public function getRedirectDuration() {
        return $this->redirectDuration;
    }

    /**
     * @param int $redirectDuration
     */
    public function setRedirectDuration($redirectDuration) {
        $this->redirectDuration = $redirectDuration;
    }

    /**
     * @return int
     */
    public function getConnectDuration() {
        return $this->connectDuration;
    }

    /**
     * @param int $connectDuration
     */
    public function setConnectDuration($connectDuration) {
        $this->connectDuration = $connectDuration;
    }

    /**
     * @return int
     */
    public function getBackendDuration() {
        return $this->backendDuration;
    }

    /**
     * @param int $backendDuration
     */
    public function setBackendDuration($backendDuration) {
        $this->backendDuration = $backendDuration;
    }

    /**
     * @return int
     */
    public function getFirstPaintTime() {
        return $this->firstPaintTime;
    }

    /**
     * @param int $firstPaintTime
     */
    public function setFirstPaintTime($firstPaintTime) {
        $this->firstPaintTime = $firstPaintTime;
    }

    /**
     * @return int
     */
    public function getDomInteractiveTime() {
        return $this->domInteractiveTime;
    }

    /**
     * @param int $domInteractiveTime
     */
    public function setDomInteractiveTime($domInteractiveTime) {
        $this->domInteractiveTime = $domInteractiveTime;
    }

    /**
     * @return int
     */
    public function getDomContentLoadedTime() {
        return $this->domContentLoadedTime;
    }

    /**
     * @param int $domContentLoadedTime
     */
    public function setDomContentLoadedTime($domContentLoadedTime) {
        $this->domContentLoadedTime = $domContentLoadedTime;
    }

    /**
     * @return int
     */
    public function getDomContentLoadedDuration() {
        return $this->domContentLoadedDuration;
    }

    /**
     * @param int $domContentLoadedDuration
     */
    public function setDomContentLoadedDuration($domContentLoadedDuration) {
        $this->domContentLoadedDuration = $domContentLoadedDuration;
    }

    /**
     * @return int
     */
    public function getOnloadTime() {
        return $this->onloadTime;
    }

    /**
     * @param int $onloadTime
     */
    public function setOnloadTime($onloadTime) {
        $this->onloadTime = $onloadTime;
    }

    /**
     * @return int
     */
    public function getOnloadDuration() {
        return $this->onloadDuration;
    }

    /**
     * @param int $onloadDuration
     */
    public function setOnloadDuration($onloadDuration) {
        $this->onloadDuration = $onloadDuration;
    }

    /**
     * @return int
     */
    public function getFullyLoadedTime() {
        return $this->fullyLoadedTime;
    }

    /**
     * @param int $fullyLoadedTime
     */
    public function setFullyLoadedTime($fullyLoadedTime) {
        $this->fullyLoadedTime = $fullyLoadedTime;
    }

    /**
     * @return int
     */
    public function getRumSpeedIndex() {
        return $this->rumSpeedIndex;
    }

    /**
     * @param int $rumSpeedIndex
     */
    public function setRumSpeedIndex($rumSpeedIndex) {
        $this->rumSpeedIndex = $rumSpeedIndex;
    }

	/**
	 * @return array
	 */
	public function getResources() {
		return $this->resources;
	}

	/**
	 * @param array $resources
	 */
	public function setResources($resources) {
		$this->resources = $resources;
	}

	/**
	 * @return string
	 */
	public function __toString() {
		return $this->getId();
	}
}
