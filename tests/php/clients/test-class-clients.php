<?php
/**
 * Tests the functionality in clients/class-clients.php
 *
 * @package QueueWP
 * @since 0.1
 */

use QueueWP\Clients\Clients;

class Test_Clients extends \WP_UnitTestCase {
	/**
	 * Instance of the Clients class
	 *
	 * @since 0.1
	 * @var Clients
	 */
	public $instance;

	/**
	 * Setup the tests.
	 *
	 * @since 0.1
	 */
	public function setUp() {
		parent::setUp();

		$this->instance = new Clients();
	}

	/**
	 * Test that registered clients are added and returned.
	 *
	 * @since 0.1
	 * @covers QueueWP\Clients\Clients::get_clients()
	 */
	public function test_get_clients() {
		add_filter( 'queuewp_clients', function( $clients ) {
			$clients['test'] = array(
				'label' => 'Test',
			);
			return $clients;
		} );

		$clients = $this->instance->get_clients();
		$this->assertNotEmpty( $clients['test'] );
		$this->assertContains( 'Test', $clients['test']['label'] );
	}
}
