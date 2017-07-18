<?php
/**
 * Utility: Template class
 *
 * Deals with templating on the front and back end.
 *
 * @package QueueWP\Utility
 * @since 0.1
 */

namespace QueueWP\Utility;

use QueueWP\QueueWP;

/**
 * Class Template
 *
 * Provides functionality for loading templates.
 *
 * @package QueueWP\Setup
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
		$template = QueueWP::get()->plugin_dir . 'templates/' . $template_path . '.php';

		if ( file_exists( $template ) ) {
			include( $template );
		}
	}
}
