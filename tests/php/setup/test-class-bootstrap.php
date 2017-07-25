<?php
/**
 * Tests: Bootstrap class
 *
 * Tests the functionality in setup/class-bootstrap.php
 *
 * @package QueueWP
 * @since 0.1
 */

use QueueWP\Setup\Bootstrap;

/**
 * Class Test_Bootstrap
 *
 * Tests for the Bootstrap class methods.
 *
 * @since 0.1
 * @covers QueueWP\Setup\Bootstrap
 */
class Test_Bootstrap extends \WP_UnitTestCase {
	/**
	 * Instance of the Bootstrap class
	 *
	 * @since 0.1
	 * @var Bootstrap
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

		$this->instance = new Bootstrap();
	}

	/**
	 * Tests if objects are created.
	 *
	 * @since 0.1
	 * @covers QueueWP\Setup\Bootstrap::setup_init()
	 */
	public function test_setup_init() {
		$this->instance->setup_init();
		$this->assertNotEmpty( $this->instance->setup->custom_post_types );
		$this->assertInstanceOf( 'QueueWP\Setup\Custom_Post_Types', $this->instance->setup->custom_post_types );
	}

	/**
	 * Tests if accounts objects are created.
	 *
	 * @since 0.1
	 * @covers QueueWP\Setup\Bootstrap::accounts_init()
	 */
	public function test_accounts_init() {
		$this->instance->accounts_init();
		$this->assertNotEmpty( $this->instance->accounts->accounts );
		$this->assertInstanceOf( 'QueueWP\Accounts\Accounts', $this->instance->accounts->accounts );
		$this->assertTrue( is_array( $this->instance->accounts->clients ) );
		$this->assertInstanceOf( 'QueueWP\Accounts\Facebook', $this->instance->accounts->clients['facebook'] );
		$this->assertInstanceOf( 'QueueWP\Accounts\Twitter', $this->instance->accounts->clients['twitter'] );
	}

	/**
	 * Tests if objects are created.
	 *
	 * @since 0.1
	 * @covers QueueWP\Setup\Bootstrap::utility_init()
	 */
	public function test_utility_init() {
		$this->instance->utility_init();
		$this->assertNotEmpty( $this->instance->utility->template );
		$this->assertInstanceOf( 'QueueWP\Utility\Template', $this->instance->utility->template );
	}

	/**
	 * Tests if admin objects are created.
	 *
	 * @since 0.1
	 * @covers QueueWP\Setup\Bootstrap::schedule_init()
	 */
	public function test_schedule_init() {
		$this->instance->schedule_init();
		$this->assertNotEmpty( $this->instance->schedule->schedule );
		$this->assertInstanceOf( 'QueueWP\Schedule\Schedule', $this->instance->schedule->schedule );
	}
}
