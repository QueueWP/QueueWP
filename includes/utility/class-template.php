<?php
/**
 * Utility: Template class
 *
 * Deals with templating on the front and back end.
 *
 * @package Social_Queue\Utility
 * @since 0.1
 */

namespace Social_Queue\Utility;

use Social_Queue\Social_Queue;

/**
 * Class Template
 *
 * Provides functionality for loading templates.
 *
 * @package Social_Queue\Setup
 * @since 0.1
 */
class Template {
	/**
	 * Load
	 *
	 * Loads a template/view.
	 *
	 * @param string $template_path Path the the template relative to the
	 * templates directory.
	 */
	public function load( $template_path ) {
		$template = Social_Queue::get()->plugin_dir . 'templates/' . $template_path;

		if ( file_exists( $template ) ) {
			include( $template );
		}
	}
}
