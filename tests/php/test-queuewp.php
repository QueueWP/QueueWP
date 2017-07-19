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
	 * Tests that an instand sets up the global paths.
	 *
	 * @since 0.1
	 * @covers QueueWP::__construct()
	 */
	public function test_construct() {
		$this->assertTrue( strlen( QueueWP::get()->plugin_url ) > 0 );
		$this->assertTrue( strlen( QueueWP::get()->plugin_dir ) > 0 );
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
		$this->assertInstanceOf( 'QueueWP\QueueWP', QueueWP::get() );

		$instance2 = QueueWP::get();
		$this->assertTrue( QueueWP::get() === $instance2 );
	}

	/**
	 * Tests that files are loaded and objects are created.
	 *
	 * @since 0.1
	 * @covers QueueWP::setup()
	 */
	public function test_setup() {
		$this->assertTrue( class_exists( 'QueueWP\Setup\Bootstrap' ) );
		$this->assertInstanceOf( 'QueueWP\Setup\Bootstrap', QueueWP::get()->setup->bootstrap );
		$this->assertTrue( is_object( QueueWP::get()->admin ) );
		$this->assertTrue( is_object( QueueWP::get()->utility ) );
	}
}