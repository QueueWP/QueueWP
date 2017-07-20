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
	 * Bootstrap object
	 *
	 * @since 0.1
	 * @var object $bootstrap Bootstrap object which contains all system objects.
	 */
	public $bootstrap;

	/**
	 * QueueWP constructor.
	 *
	 * @since 0.1
	 */
	public function __construct() {
		$this->plugin_dir = plugin_dir_path( __FILE__ );
		$this->plugin_url = plugin_dir_url( __FILE__ );
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
		$this->bootstrap = new Bootstrap();
		$this->bootstrap->init();
	}

	/**
	 * Returns the setup objects created by Bootstrap.
	 *
	 * @since 0.1
	 * @return \stdClass
	 */
	public function setup() {
		return $this->bootstrap->setup;
	}

	/**
	 * Returns the admin objects created by Bootstrap.
	 *
	 * @since 0.1
	 * @return \stdClass
	 */
	public function admin() {
		return $this->bootstrap->admin;
	}

	/**
	 * Returns the utility objects created by Bootstrap.
	 *
	 * @since 0.1
	 * @return \stdClass
	 */
	public function utility() {
		return $this->bootstrap->utility;
	}
}

/**
 * Autoloader to automatically require our class files.
 *
 * @since 1.0
 */
function autoload( $class ) {
	if ( strpos( $class, 'QueueWP\\' ) !== 0 ) {
		return;
	}

	$class = strtolower( str_replace( array( 'QueueWP\\', '_' ), array( '', '-' ), $class ) );
	$paths = explode( '\\', $class );
	$class = array_pop( $paths );

	$file = plugin_dir_path( __FILE__ ) . 'includes/' . implode( '/', $paths ) . '/class-' . $class . '.php';

	if ( file_exists( $file ) ) {
		require_once( $file );
	}
}

spl_autoload_register( '\QueueWP\autoload' );

/*
 * Kick things off immediately by creating an instance of the plugin.
 */
QueueWP::get();
