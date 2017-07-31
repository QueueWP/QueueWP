<?php
/**
 * Handles the authentication and setup of a QueueWP account.
 *
 * @package QueueWP\Clients
 * @since 0.1
 */

namespace QueueWP\Clients;

/**
 * Class QueueWP
 *
 * @package QueueWP\Clients
 * @since 0.1
 */
class QueueWP {
	/**
	 * The key of the client.
	 *
	 * @since 0.1
	 */
	const ACCOUNT_KEY = 'queuewp';

	/**
	 * Init.
	 *
	 * @since 0.1
	 */
	public function init() {
		add_action( 'queuewp_clients', array( $this, 'register_client' ) );
	}

	/**
	 * Register the QueueWP client.
	 *
	 * @since 0.1
	 * @param array $clients Already registered clients.
	 * @return array $clients List of clients.
	 */
	public function register_client( $clients ) {
		$clients[ self::ACCOUNT_KEY ] = array(
			'label' => __( 'QueueWP', 'queuewp' ),
			'icon'  => '',
		);

		return $clients;
	}

	/**
	 * Render the client connection form.
	 *
	 * @since 0.1
	 */
	public function render_settings() {
		$token = '';

		if ( empty( $token ) ) {
			\QueuewP\QueueWP::get()->utility()->template->load( 'clients/queuewp-connect' );
		}
	}
}
