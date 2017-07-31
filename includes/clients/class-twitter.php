<?php
/**
 * Twitter Client
 *
 * Handles the authentication and setup of a Twitter account.
 *
 * @package QueueWP\Clients
 * @since 0.1
 */

namespace QueueWP\Clients;

/**
 * Class Twitter
 *
 * @package QueueWP\Clients
 * @since 0.1
 */
class Twitter {
	/**
	 * The key of the client.
	 *
	 * @since 0.1
	 */
	const ACCOUNT_KEY = 'twitter';

	/**
	 * Init.
	 *
	 * @since 0.1
	 */
	public function init() {
		add_action( 'queuewp_clients', array( $this, 'register_client' ) );
	}

	/**
	 * Register the Twitter account client.
	 *
	 * @since 0.1
	 * @param array $clients Already registered clients.
	 * @return array $clients List of clients.
	 */
	public function register_client( $clients ) {
		$clients[ self::ACCOUNT_KEY ] = array(
			'label' => __( 'Twitter', 'queuewp' ),
			'icon'  => 'dashicons-twitter',
		);

		return $clients;
	}
}
