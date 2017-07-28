<?php
/**
 * Setup: Scheduler class
 *
 * Handles scheduling of posts to social networks.
 *
 * @package QueueWP
 * @since 0.1
 */

namespace QueueWP\Schedule;

use QueueWP\Setup\Custom_Post_Types;

/**
 * Class Scheduler
 *
 * @package QueueWP
 * @since 0.1
 */
class Scheduler {
	public function init() {
		add_action( 'save_post', array( $this, 'queue_post' ) );
	}

	public function queue_post( $post_id ) {
		if ( wp_is_post_revision( $post_id ) ) {
			return;
		}

		$post = get_post( $post_id );

		if ( 'publish' !== $post->post_status ) {
			return;
		}

		// @todo: Get the accounts this should be submitted to
		$accounts = array( 'facebook' );

		// @todo: Implement check to make sure we should add it to the queue

		if ( ! empty( $accounts ) ) {
			remove_action( 'save_post', array( $this, 'queue_post' ) );

			$this->add_to_queue( $post_id, $accounts, 'Test social network post' );

			add_action( 'save_post', array( $this, 'queue_post' ) );
		}
	}

	/**
	 * Adds a post to the queue to be sent to social networks.
	 *
	 * @since 2.1
	 * @param int    $parent   The ID of the parent post (the post to be sent to social).
	 * @param array  $accounts Array of accounts where the post should be sent to.
	 * @param string $content  The content to be shared.
	 * @param string $datetime The datetime when this post should be sent out.
	 * @param array  $images   Array of images to be shared.
	 * @param array  $urls     Array of data for the URL being shared.
	 * @return int|\WP_Error
	 */
	public function add_to_queue( $parent = 0, $accounts = array(), $content, $datetime = '', $images = array(), $urls = array() ) {
		if ( empty( $accounts ) ) {
			return new \WP_Error( 'queuewp-error', __( 'A n account must be selected when scheduling a post', 'queuewp' ) );
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
				'post_title'   => $content,
				'post_content' => '',
				'post_date'    => $datetime,
				'post_status'  => 'publish',
				'meta_input'   => array(
					'parent'   => $parent,
					'accounts' => $accounts,
					'url'      => array( $urls ),
				),
			)
		);

		// @todo: Do we need to kick off the job already?

		return $result;
	}
}
