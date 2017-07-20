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

use QueueWP\Admin\Meta_Box;
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
	 * Setup
	 *
	 * Class containing setup functionality objects.
	 *
	 * @since 0.1
	 * @var object
	 */
	public $setup;

	/**
	 * Admin
	 *
	 * Class containing admin functionality objects.
	 *
	 * @since 0.1
	 * @var object
	 */
	public $admin;

	/**
	 * Utility
	 *
	 * Class containing utility functionality objects.
	 *
	 * @since 0.1
	 * @var object
	 */
	public $utility;

	public function __construct() {
		$this->setup   = new \stdClass;
		$this->admin   = new \stdClass;
		$this->utility = new \stdClass;
	}

	/**
	 * Bootstrap constructor.
	 *
	 * @since 0.1
	 */
	public function init() {
		/**
		 * Setup functionality.
		 */
		$this->setup_init();

		/**
		 * Admin related functionality.
		 */
		if ( is_admin() ) {
			$this->admin_init();
		}

		/**
		 * General functionality.
		 */
		$this->general_init();
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
	public function general_init() {
		$this->utility->template = new Template();
	}

	/**
	 * Creates objects from the classes that we loaded used for the admin
	 * functionality inside the WP Admin area.
	 *
	 * @since 0.1
	 */
	public function admin_init() {
		$this->admin->meta_box = new Meta_Box();
		$this->admin->meta_box->init();
	}
}
