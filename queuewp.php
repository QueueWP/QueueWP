<?php
/**
 * Init: QueueWP class
 *
 * Main plugin file which is used for setting up and creating the plugin.
 *
 * @package QueueWP
 * @since 0.1
 */

/**
 * Plugin Name: QueueWP
 * Version: 0.1
 * Plugin URI: https://queuewp.com
 * Description: Automate and track social networking postings
 * Author: QueueWP
 * Author URI: https://queuewp.com
 * Text Domain: queuewp
 * License: GPL v3
 */

namespace QueueWP;

use QueueWP\Setup\Bootstrap;

/**
 * Class QueueWP
 *
 * Main class used for initializing the whole plugin.
 *
 * @package QueueWP
 * @since 0.1
 */
class QueueWP {
	/**
	 * Instance
	 *
	 * @since 0.1
	 * @var object $instance Static instance of the plugin.
	 */
	public static $instance;

	/**
	 * Plugin Dir
	 *
	 * @since 0.1
	 * @var string $plugin_dir The path to the plugin root directory.
	 */
	public $plugin_dir;

	/**
	 * Plugin URL
	 *
	 * @since 0.1
	 * @var string $plugin_url The URL to the plugin root directory.
	 */
	public $plugin_url;

	/**
	 * Setup
	 *
	 * @since 0.1
	 * @var object $setup Collection of objects used for setup.
	 */
	public $setup;

	/**
	 * Utility
	 *
	 * @since 0.1
	 * @var object $admin Collection of objects used for utility.
	 */
	public $utility;

	/**
	 * Admin
	 *
	 * @since 0.1
	 * @var object $admin Collection of objects used for admin.
	 */
	public $admin;

	/**
	 * QueueWP constructor.
	 *
	 * @since 0.1
	 */
	public function __construct() {
		$this->plugin_dir = plugin_dir_path( __FILE__ );
		$this->plugin_url = plugin_dir_url( __FILE__ );

		$this->setup = new \stdClass;
	}

	/**
	 * Part of the singleton pattern, this method is used to return only a
	 * single instance of the QueueWP object and ensure that it will only
	 * ever get created once in memory.
	 *
	 * @since 0.1
	 * @return object
	 */
	public static function get() {
		if ( empty( QueueWP::$instance ) ) {
			QueueWP::$instance = new QueueWP();
			QueueWP::$instance->init();
		}

		return QueueWP::$instance;
	}

	/**
	 * Gets the party started - i.e. sets up plugin objects.
	 *
	 * @since 0.1
	 */
	public function init() {
		require_once( $this->plugin_dir . '/includes/setup/class-bootstrap.php' );
		$this->setup->bootstrap = new Bootstrap();
		$this->setup->bootstrap->init();

		$this->setup   = (object) array_merge( (array) $this->setup, (array) $this->setup->bootstrap->get_setup_collection() );
		$this->admin   = $this->setup->bootstrap->get_admin_collection();
		$this->utility = $this->setup->bootstrap->get_utility_collection();
	}
}

/**
 * Kick things off immediately by creating an instance of the plugin.
 */
QueueWP::get();
