<div id="queuewp-accounts">
	<label for="account_client"><?php esc_html_e( 'Choose account type', 'queuewp' ); ?></label>
	<select name="account_client" class="account_client">
		<option><?php esc_html_e( '-- Select --', 'queuewp' ); ?></option>
		<?php if ( ! empty( $data['clients'] ) ) : ?>
			<?php foreach ( $data['clients'] as $client => $client_data ) : ?>
				<option value="<?php echo esc_attr( $client ); ?>"><?php echo esc_html( $client_data['label'] ); ?></option>
			<?php endforeach; ?>
		<?php endif; ?>
	</select>

	<div id="queuewp-account-settings"></div>
</div>
