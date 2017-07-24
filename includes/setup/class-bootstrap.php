<?php
/**
 * Setup: Bootstrap class
 *
 * Responsible for loading and creating instances of all objects needed for
 * plugin to run.
 *
 * @package QueueWP
 * @since 0.1
 */

namespace QueueWP\Setup;

use QueueWP\Accounts\Accounts;
use QueueWP\Accounts\Facebook;
use QueueWP\Accounts\Twitter;
use QueueWP\Schedule\Schedule;
use QueueWP\Schedule\Scheduler;
use QueueWP\Utility\Template;
use QueueWP\Setup\Custom_Post_Types;

/**
 * Class Bootstrap
 *
 * Used for including files needed in the plugin.
 *
 * @package QueueWP
 * @since 0.1
 */
class Bootstrap {
	/**
	 * Class containing setup functionality objects.
	 *
	 * @since 0.1
	 * @var object
	 */
	public $setup;

	/**
	 * Class containing utility functionality objects.
	 *
	 * @since 0.1
	 * @var object
	 */
	public $utility;

	/**
	 * Class containing accounts functionality objects.
	 *
	 * @since 0.1
	 * @var object
	 */
	public $accounts;

	/**
	 * Class containing schedule functionality objects.
	 *
	 * @since 0.1
	 * @var object
	 */
	public $schedule;

	/**
	 * Bootstrap constructor.
	 *
	 * @since 0.1
	 */
	public function __construct() {
		$this->setup    = new \stdClass;
		$this->utility  = new \stdClass;
		$this->accounts = new \stdClass;
		$this->schedule = new \stdClass;
	}

	/**
	 * Init.
	 *
	 * @since 0.1
	 */
	public function init() {
		/**
		 * Setup functionality.
		 */
		$this->setup_init();

		/**
		 * Utility functionality.
		 */
		$this->utility_init();

		/**
		 * Accounts functionality.
		 */
		if ( is_admin() ) {
			$this->accounts_init();
		}

		/**
		 * Schedule related functionality.
		 */
		if ( is_admin() ) {
			$this->schedule_init();
		}
	}

	/**
	 * Creates objects for the setup functionality we provide.
	 *
	 * @since 0.1
	 */
	public function setup_init() {
		$this->setup->custom_post_types = new Custom_Post_Types();
		$this->setup->custom_post_types->init();
	}

	/**
	 * Creates objects for the utility functionality we provide.
	 *
	 * @since 0.1
	 */
	public function utility_init() {
		$this->utility->template = new Template();
	}

	/**
	 * Creates objects from the classes that we loaded used for the accounts
	 * functionality inside the WP Admin area.
	 *
	 * @since 0.1
	 */
	public function accounts_init() {
		$this->accounts->accounts = new Accounts();
		$this->accounts->accounts->init();

		// Clients.
		$this->accounts->clients[ Facebook::ACCOUNT_KEY ] = new Facebook();
		$this->accounts->clients[ Twitter::ACCOUNT_KEY ] = new Twitter();

		// Init clients.
		$this->accounts->clients[ Facebook::ACCOUNT_KEY ]->init();
		$this->accounts->clients[ Twitter::ACCOUNT_KEY ]->init();
	}

	/**
	 * Creates objects from the classes that we loaded used for the schedule
	 * functionality inside the WP Admin area.
	 *
	 * @since 0.1
	 */
	public function schedule_init() {
		$this->schedule->schedule = new Schedule();
		$this->schedule->schedule->init();

		$this->schedule->scheduler = new Scheduler();
	}
}
