<?php
/**
 * Setup: Schedule class
 *
 * Handles scheduling of posts to social networks.
 *
 * @package QueueWP
 * @since 0.1
 */

namespace QueueWP\Schedule;

use QueueWP\Setup\Custom_Post_Types;

/**
 * Class Schedule
 *
 * @package QueueWP
 * @since 0.1
 */
class Schedule {
	/**
	 * Adds a post to the queue to be sent to social networks.
	 *
	 * @since 2.1
	 * @param int    $parent   The ID of the parent post (the post to be sent to social).
	 * @param array  $networks Array of networks where the post should be sent to.
	 * @param string $content  The content to be shared.
	 * @param string $datetime The datetime when this post should be sent out.
	 * @param array  $images   Array of images to be shared.
	 * @param array  $url_data Array of data for the URL being shared.
	 * @return int|\WP_Error
	 */
	public function add_to_queue( $parent = 0, $networks = array(), $content, $datetime = '', $images = array(), $url_data = array() ) {
		if ( empty ( $networks ) ) {
			return new \WP_Error( 'queuewp-error', __( 'A social network must be selected when scheduling a post', 'queuewp' ) );
		}

		if ( empty( $content ) ) {
			return new \WP_Error( 'queuewp-error', __( 'Unable to schedule post without content defined', 'queuewp' ) );
		}

		if ( empty( $datetime ) ) {
			$datetime = date( 'Y-m-d H:i:s' );
		}

		/*
		 * Make sure a post is not scheduled to go out in the past. We add 5
		 * seconds for slow servers ;)
		 */
		if ( strtotime( $datetime ) + 5 < time() ) {
			return new \WP_Error( 'queuewp-error', __( 'Cannot schedule a post in the past', 'queuewp' ) );
		}

		// @todo: Add images to media gallery if not added already.

		$result = wp_insert_post(
			array(
				'post_type'    => Custom_Post_Types::QUEUE_POST_TYPE_NAME,
				'post_content' => $content,
				'post_date'    => $datetime,
				'meta_input'   => array(
					'parent'   => $parent,
					'networks' => $networks,
					'url_data' => $url_data,
				),
			)
		);

		// @todo: Do we need to kick off the job already?

		return $result;
	}
}
