<?php
/**
 * Facebook Client
 *
 * Handles the authentication and setup of a Facebook account.
 *
 * @package QueueWP\Clients
 * @since 0.1
 */

namespace QueueWP\Clients;

use QueueWP\QueueWP;

/**
 * Class Facebook
 *
 * @package QueueWP\Clients
 * @since 0.1
 */
class Facebook {
	/**
	 * The key of the client.
	 *
	 * @since 0.1
	 */
	const ACCOUNT_KEY = 'facebook';

	/**
	 * Init.
	 *
	 * @since 0.1
	 */
	public function init() {
		add_action( 'queuewp_clients', array( $this, 'register_client' ) );
	}

	/**
	 * Register the Facebook account client.
	 *
	 * @since 0.1
	 * @param array $clients Already registered clients.
	 * @return array $clients List of clients.
	 */
	public function register_client( $clients ) {
		$clients[ self::ACCOUNT_KEY ] = array(
			'label' => __( 'Facebook', 'queuewp' ),
			'icon'  => 'dashicons-facebook',
		);

		return $clients;
	}

	/**
	 * Render the account client connection form.
	 *
	 * @since 0.1
	 */
	public function render_settings() {
		$token = '';

		if ( empty( $token ) ) {
			QueueWP::get()->utility()->template->load( 'clients/facebook-connect' );
		}
	}
}
