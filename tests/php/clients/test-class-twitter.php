<?php
/**
 * Tests the functionality in clients/class-twitter.php
 *
 * @package QueueWP
 * @since 0.1
 */

use QueueWP\Clients\Twitter;

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
	 * @covers QueueWP\Clients\Twitter::init()
	 */
	public function test_init() {
		$this->instance->init();
		$this->assertEquals( 10, has_filter( 'queuewp_clients', array( $this->instance, 'register_client' ) ) );
	}

	/**
	 * Tests that Twitter gets added to the registered account clients array.
	 *
	 * @since 0.1
	 * @covers QueueWP\Clients\Twitter::register_client()
	 */
	public function test_register_client() {
		$client = $this->instance->register_client( array() );
		$this->assertNotEmpty( $client['twitter'] );
		$this->assertContains( 'Twitter', $client['twitter']['label'] );
	}
}
