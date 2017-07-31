<?php
/**
 * Tests the functionality in utility/class-template.php
 *
 * @package QueueWP
 * @since 0.1
 */

use QueueWP\QueueWP;
use QueueWP\Utility\Template;
use QueueWP\Setup\Custom_Post_Types;

/**
 * Class Test_Template
 *
 * Tests for the Template class methods.
 *
 * @since 0.1
 * @covers QueueWP\Utility\Template
 */
class Test_Template extends \WP_UnitTestCase {
	/**
	 * Instance of the Template class
	 *
	 * @since 0.1
	 * @var Template
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
		set_current_screen( 'edit-' . Custom_Post_Types::ACCOUNTS_POST_TYPE_NAME );

		/*
		 * Re-run init on QueueWP class to re-create bootstrap and take in to
		 * account that we're now admin.
		 */
		QueueWP::get()->init();

		$this->instance = new Template();
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
	 * Make sure that a template gets loaded.
	 *
	 * @since 0.1
	 * @covers QueueWP\Utility\Template::load()
	 */
	public function test_load() {
		ob_start();
		$this->instance->load( 'schedule/meta-box' );
		$template = ob_get_clean();

		$this->assertContains( '<div id="queuewp-meta-box">', $template );
	}

	/**
	 * Make sure that data gets passed through to a template.
	 *
	 * @since 0.1
	 * @covers QueueWP\Utility\Template::load()
	 */
	public function test_load_data() {
		ob_start();
		$this->instance->load( 'accounts/meta-box', array( 'clients' => array( 'twitter' => array( 'label' => 'Twitter' ) ) ) );
		$template = ob_get_clean();

		$this->assertContains( '<option value="twitter">Twitter</option>', $template );
	}
}
