<?php
/**
 * Init: Social_Queue class
 *
 * Main plugin file which is used for setting up and creating the plugin.
 *
 * @package Social_Queue
 * @since 0.1
 */

/**
 * Plugin Name: Social Queue by WPGeeks.com
 * Version: 0.1
 * Plugin URI: https://wpgeeks.com/labs/social-queue/
 * Description: Schedule and customize your content to Social networks
 * Author: WPGeeks
 * Author URI: https://wpgeeks.com/
 * Text Domain: social-queue
 * License: GPL v3
 */

namespace Social_Queue;

use Social_Queue\Setup\Load;

/**
 * Class Social_Queue
 *
 * Main class used for initializing the whole plugin.
 *
 * @package Social_Queue
 * @since 0.1
 */
class Social_Queue {
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
	 * Social_Queue constructor.
	 *
	 * @since 0.1
	 */
	public function __construct() {
		$this->plugin_dir = plugin_dir_path( __FILE__ );
		$this->plugin_url = plugin_dir_url( __FILE__ );

		$this->setup = new \stdClass;

		add_action( 'init', array( $this, 'setup' ) );
	}

	/**
	 * Get
	 *
	 * Part of the singleton pattern, this method is used to return only a
	 * single instance of the Social_Queue object and ensure that it will only
	 * ever get created once in memory.
	 *
	 * @since 0.1
	 * @return object
	 */
	public static function get() {
		if ( empty( Social_Queue::$instance ) ) {
			Social_Queue::$instance = new Social_Queue();
		}

		return Social_Queue::$instance;
	}

	/**
	 * Setup
	 *
	 * Gets the party started - i.e. sets up plugin objects.
	 *
	 * @since 0.1
	 */
	public function setup() {
		require_once( $this->plugin_dir . '/includes/setup/class-load.php' );
		$this->setup->load = new Load();

		$this->admin   = $this->setup->load->get_admin_collection();
		$this->utility = $this->setup->load->get_utility_collection();
	}
}

/**
 * Kick things off immediately by creating an instance of the plugin.
 */
Social_Queue::get();
