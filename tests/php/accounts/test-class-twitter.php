<?php
/**
 * Tests: Twitter
 *
 * Tests the functionality in accounts/class-twitter.php
 *
 * @package QueueWP
 * @since 0.1
 */

use QueueWP\Accounts\Twitter;

class Test_Twitter extends \WP_UnitTestCase {
	/**
	 * Instance of the Twitter class
	 *
	 * @since 0.1
	 * @var Twitter
	 */
	public $instance;

	/**
	 * Setup the tests.
	 *
	 * @since 0.1
	 */
	public function setUp() {
		parent::setUp();

		$this->instance = new Twitter();
	}

	/**
	 * Tests that actions are registered.
	 *
	 * @since 0.1
	 * @covers QueueWP\Accounts\Twitter::init()
	 */
	public function test_init() {
		$this->instance->init();
		$this->assertEquals( 10, has_filter( 'queuewp_accounts', array( $this->instance, 'register_account' ) ) );
	}

	/**
	 * Tests that Twitter gets added to the registered accounts array.
	 *
	 * @since 0.1
	 * @covers QueueWP\Accounts\Twitter::register_account()
	 */
	public function test_register_account() {
		$accounts = $this->instance->register_account( array() );
		$this->assertContains( 'Twitter', $accounts );
	}
}
