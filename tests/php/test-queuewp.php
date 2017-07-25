<?php
/**
 * Tests: QueueWP class
 *
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

		$this->instance = QueueWP::get();
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
