<div class="wrap">
	<h1><?php esc_html_e( 'QueueWP Settings', 'queuewp' ); ?></h1>

	<?php if ( empty( $connected ) ) : ?>
		<p><?php esc_html_e( 'Connect to QueueWP (so that we can post to your Facebook and Twitter accounts)', 'queuewo' ); ?></p>

		<form>
			<label for="email_address">Email Address</label>
			<input type="text" name="email_address" />
			<label for="password">Password</label>
			<input type="password" name="password" />
			<input type="submit" value="Connect" />
		</form>
	<?php endif; ?>
</div>