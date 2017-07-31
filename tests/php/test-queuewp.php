<?php
/**
 * Tests the functionality in queuewp.php
 *
 * @package QueueWP
 * @since 0.1
 */

use QueueWP\QueueWP;

/**
 * Class Test_QueueWP
 *
 * Tests for the QueueWP class methods.
 *
 * @package QueueWP
 * @since 0.1
 */
class Test_QueueWP extends WP_UnitTestCase {
	/**
	 * Instance of the QueueWP class
	 *
	 * @since 0.1
	 * @var QueueWP
	 */
	public $instance;

	/**
	 * Setup the tests.
	 *
	 * @since 0.1
	 */
	public function setUp() {
		parent::setUp();

		/*
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

		$this->instance = QueueWP::get();
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
	 * Tests that an instand sets up the global paths.
	 *
	 * @since 0.1
	 * @covers QueueWP::__construct()
	 */
	public function test_construct() {
		$this->assertTrue( strlen( $this->instance->plugin_url ) > 0 );
		$this->assertTrue( strlen( $this->instance->plugin_dir ) > 0 );
	}

	/**
	 * Test that only one of the same instance will get returned and exist in
	 * memory.
	 *
	 * @since 0.1
	 * @covers QueueWP::get()
	 */
	public function test_get() {
		$this->assertTrue( is_object( QueueWP::get() ) );
		$this->assertInstanceOf( 'QueueWP\QueueWP', $this->instance );

		$instance2 = QueueWP::get();
		$this->assertTrue( $this->instance === $instance2 );
	}

	/**
	 * Tests that setup returns an object with setup objects.
	 *
	 * @since 0.1
	 * @covers QueueWP::setup()
	 */
	public function test_setup() {
		$this->assertTrue( class_exists( 'QueueWP\Setup\Bootstrap' ) );
		$this->assertInstanceOf( '\stdClass', $this->instance->setup() );
		$this->assertInstanceOf( 'QueueWP\Setup\Custom_Post_Types', $this->instance->setup()->custom_post_types );
	}

	/**
	 * Tests that utility returns an object with utility objects.
	 *
	 * @since 0.1
	 * @covers QueueWP::utility()
	 */
	public function test_utility() {
		$this->assertInstanceOf( '\stdClass', $this->instance->utility() );
		$this->assertInstanceOf( 'QueueWP\Utility\Template', $this->instance->utility()->template );
	}

	/**
	 * Tests that settings returns an object with settings objects.
	 *
	 * @since 0.1
	 * @covers QueueWP::settings()
	 */
	public function test_settings() {
		$this->assertInstanceOf( '\stdClass', $this->instance->settings() );
		$this->assertInstanceOf( 'QueueWP\Settings\Settings', $this->instance->settings()->settings );
	}

	/**
	 * Tests that clients returns an object with client objects.
	 *
	 * @since 0.1
	 * @covers QueueWP::clients()
	 */
	public function test_clients() {
		$this->assertInstanceOf( '\stdClass', $this->instance->clients() );
		$this->assertInstanceOf( 'QueueWP\Clients\Clients', $this->instance->clients()->clients );
	}

	/**
	 * Tests that accounts returns an object with accounts objects.
	 *
	 * @since 0.1
	 * @covers QueueWP::accounts()
	 */
	public function test_accounts() {
		$this->assertInstanceOf( '\stdClass', $this->instance->accounts() );
		$this->assertInstanceOf( 'QueueWP\Accounts\Accounts', $this->instance->accounts()->accounts );
	}

	/**
	 * Tests that admin returns an object with schedule objects.
	 *
	 * @since 0.1
	 * @covers QueueWP::schedule()
	 */
	public function test_schedule() {
		$this->instance->init();
		$this->assertInstanceOf( '\stdClass', $this->instance->schedule() );
		$this->assertInstanceOf( 'QueueWP\Schedule\Schedule', $this->instance->schedule()->schedule );
	}

	/**
	 * Tests that classes are autoloaded.
	 *
	 * @since 0.1
	 * @covers autoload()
	 */
	public function test_autoload() {
		$this->assertTrue( class_exists( 'QueueWP\Utility\Template' ) );
		$this->assertTrue( class_exists( 'QueueWP\Schedule\Schedule' ) );
	}
}
