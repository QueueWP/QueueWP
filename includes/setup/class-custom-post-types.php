<?php
/**
 * Setup: Custom Post Type class
 *
 * Creates CPT's that we need.
 *
 * @package QueueWP
 * @since 0.1
 */

namespace QueueWP\Setup;

/**
 * Class Custom_Post_Types
 *
 * @package QueueWP
 * @since 0.1
 */
class Custom_Post_Types {
	/**
	 * Adds actions to setup the Custom Post Types.
	 *
	 * @since 0.1
	 */
	public function init() {
		add_action( 'init', array( $this, 'setup' ) );
	}

	/**
	 * Creates the Custom Post Type
	 *
	 * @since 0.1
	 */
	public function setup() {
		$labels = array(
			'name'               => _x( 'QueueWP', 'post type general name', 'queuewp' ),
			'singular_name'      => _x( 'Post', 'post type singular name', 'queuewp' ),
			'menu_name'          => _x( 'QueueWP', 'admin menu', 'queuewp' ),
			'name_admin_bar'     => _x( 'QueueWP', 'add new on admin bar', 'queuewp' ),
			'add_new'            => _x( 'Schedule Post', 'post', 'queuewp' ),
			'add_new_item'       => __( 'Schedule Post', 'queuewp' ),
			'new_item'           => __( 'Schedule Post', 'queuewp' ),
			'edit_item'          => __( 'Edit Schedule', 'queuewp' ),
			'view_item'          => __( 'View Schedule', 'queuewp' ),
			'all_items'          => __( 'Queue', 'queuewp' ),
			'search_items'       => __( 'Search Posts', 'queuewp' ),
			'parent_item_colon'  => __( 'Parent Posts:', 'queuewp' ),
			'not_found'          => __( 'No posts found.', 'queuewp' ),
			'not_found_in_trash' => __( 'No posts found in Trash.', 'queuewp' ),
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Queue of posts scheduled for social networks.', 'queuewp' ),
			'public'             => false,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => false,
			'capability_type'    => 'post',
			'capabilities'       => array(
				'edit_post'          => 'edit_post',
				'read_post'          => 'read_post',
				'delete_post'        => 'do_not_allow',
				'edit_posts'         => 'edit_posts',
				'edit_others_posts'  => 'edit_posts',
				'publish_posts'      => 'do_not_allow',
				'read_private_posts' => 'read_posts',
				'create_posts'       => 'do_not_allow',
			),
			'map_meta_cap'       => false,
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title' ),
		);

		register_post_type( 'queuewp', $args );
	}
}
