<?php
/**
 * Handles the clients for the different social networks.
 *
 * @package QueueWP\Clients
 * @since 0.1
 */

namespace QueueWP\Clients;

/**
 * Class Clients
 *
 * @package QueueWP\Clients
 * @since 0.1
 */
class Clients {
	/**
	 * Returns a list of registered clients.
	 *
	 * @since 0.1
	 * @return array
	 */
	public function get_clients() {
		/**
		 * QueueWP Clients
		 *
		 * @since 0.1
		 * @param array $clients The clients currently registered.
		 */
		return apply_filters( 'queuewp_clients', array() );
	}
}
