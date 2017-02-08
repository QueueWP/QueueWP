<?php
/**
 * Tests: Template class
 *
 * Tests the functionality in utility/class-template.php
 *
 * @package Social_Queue
 * @since 0.1
 */

use Social_Queue\Social_Queue;

/**
 * Class Test_Template
 *
 * Tests for the Template class methods.
 *
 * @covers Social_Queue\Utility\Template
 */
class Test_Template extends \WP_UnitTestCase {

	/**
	 * @covers Social_Queue\Utility\Template::load()
	 */
	public function test_should_load_a_template() {
		ob_start();
		Social_Queue::get()->utility->template->load( 'admin/meta-box.php' );
		$template = ob_get_clean();

		$this->assertContains( '<div class="social-queue-meta-box">', $template );
	}
}
