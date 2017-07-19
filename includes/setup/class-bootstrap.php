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

use QueueWP\QueueWP;
use QueueWP\Admin\Meta_Box;
use QueueWP\Utility\Template;

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

	/**
	 * Bootstrap constructor.
	 *
	 * @since 0.1
	 */
	public function init() {
		$this->setup   = new \stdClass;
		$this->admin   = new \stdClass;
		$this->utility = new \stdClass;

		$this->setup_load();
		$this->setup_init();

		/**
		 * Admin related functionality.
		 */
		if ( is_admin() ) {
			$this->load_admin();
			$this->init_admin();
		}

		/**
		 * General functionality.
		 */
		$this->general_load();
		$this->general_init();
	}

	/**
	 * Loads the classes that setup the base plugin functionality.
	 *
	 * @since 0.1
	 */
	public function setup_load() {
		require_once( QueueWP::get()->plugin_dir . 'includes/setup/class-custom-post-types.php' );
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
	 * Loads the classes that will be used throughout the plugin frontend and WP
	 * Admin.
	 *
	 * @since 0.1
	 */
	public function general_load() {
		require_once( QueueWP::get()->plugin_dir . 'includes/utility/class-template.php' );
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
	 * Loads the classes that will be used for the admin based functionality in
	 * the WP Admin area.
	 *
	 * @since 0.1
	 */
	public function load_admin() {
		require_once( QueueWP::get()->plugin_dir . 'includes/admin/class-meta-box.php' );
	}

	/**
	 * Creates objects from the classes that we loaded used for the admin
	 * functionality inside the WP Admin area.
	 *
	 * @since 0.1
	 */
	public function init_admin() {
		$this->admin->meta_box = new Meta_Box();
	}

	/**
	 * Returns an object which includes all the objects we created for the
	 * initial plugin setup.
	 *
	 * @since 0.1
	 * @return object
	 */
	public function get_setup_collection() {
		return $this->setup;
	}

	/**
	 * Returns an object which includes all the objects we created for the admin
	 * functionality inside the WP Admin area.
	 *
	 * @since 0.1
	 * @return object
	 */
	public function get_admin_collection() {
		return $this->admin;
	}

	/**
	 * Returns an object which includes all the objects we created for the
	 * utility functionality.
	 *
	 * @since 0.1
	 * @return object
	 */
	public function get_utility_collection() {
		return $this->utility;
	}
}
