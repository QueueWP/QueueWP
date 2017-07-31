<?php
/**
 * Tests: Settings
 *
 * Tests the functionality in settings/class-settings.php
 *
 * @package QueueWP
 * @since 0.1
 */

use QueueWP\QueueWP;
use QueueWP\Settings\Settings;

class Test_Settings extends \WP_UnitTestCase {
	/**
	 * Instance of the Settings class
	 *
	 * @since 0.1
	 * @var Schedule
	 */
	public $instance;

	/**
	 * Setup the tests.
	 *
	 * @since 0.1
	 */
	public function setUp() {
		parent::setUp();

		/**
		 * Fake that we're in the WordPress admin area.
		 *
		 * Rerun the setup since for this test, we want to load the files as if
		 * we're in the admin area.
		 */
		wp_set_current_user( 1 );
		set_current_screen( 'edit.php' );

		/*
		 * Re-run init on QueueWP class to re-create bootstrap and take in to
		 * account that we're now admin.
		 */
		QueueWP::get()->init();

		$this->instance = new Settings();
	}

	/**
	 * Tear down the tests.
	 *
	 * @since 0.1
	 */
	public function tearDown() {
		parent::tearDown();

		// We're not admin anymore.
		unset( $GLOBALS['current_screen'] );

		// Reset plugin so that admin objects are not created.
		QueueWP::get()->init();
	}

	/**
	 * Tests that actions are registered.
	 *
	 * @since 0.1
	 * @covers QueueWP\Settings\Settings::init()
	 */
	public function test_init() {
		$this->instance->init();
		$this->assertEquals( 10, has_action( 'admin_menu', array( $this->instance, 'create_settings_page' ) ) );
	}

	/**
	 * Tests that a settings page gets added.
	 *
	 * @since 0.1
	 * @covers QueueWP\Settings\Settings::create_settings_page()
	 */
	public function test_create_settings_page() {
		global $_registered_pages;
		$this->instance->create_settings_page();
		$this->assertTrue( ! empty( $_registered_pages[ 'admin_page_' . Settings::SETTINGS_SLUG ] ) );
	}

	/**
	 * Tests that the settings page is rendered.
	 *
	 * @since 0.1
	 * @covers QueueWP\Settings\Settings::render_settings_page()
	 */
	public function test_render_settings_page() {
		ob_start();
		$this->instance->render_settings_page();
		$settings = ob_get_clean();

		$this->assertContains( '<div class="wrap">', $settings );
	}
}
