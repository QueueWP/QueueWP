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
	 * Loads a template/view.
	 *
	 * @since 0.1
	 * @param string $template_path Path the the template relative to the templates directory.
	 */
	public function load( $template_path, $data = array() ) {
		$template = QueueWP::get()->plugin_dir . 'templates/' . $template_path . '.php';

		if ( file_exists( $template ) ) {
			include( $template );
		}
	}
}
