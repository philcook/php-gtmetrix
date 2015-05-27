<?php


namespace Opsbears\GTMetrixClient;


class GTMetrixTest {
	const STATE_QUEUED = 'queued';
	const STATE_STARTED = 'started';
	const STATE_COMPLETED = 'completed';
	const STATE_ERROR = 'error';

	/**
	 * @var string
	 */
	protected $id;

	/**
	 * @var string
	 * @see self::STATE_*
	 */
	protected $state;

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
	 * Links to more resources available
	 *
	 * @var array
	 */
	protected $resources = array();

}