<div id="queuewp-accounts">
	<label for="account_type"><?php esc_html_e( 'Choose account type', 'queuewp' ); ?></label>
	<select name="account_type" class="account_type">
		<option><?php esc_html_e( '-- Select --', 'queuewp' ); ?></option>
		<?php if ( ! empty( $data['accounts'] ) ) : ?>
			<?php foreach ( $data['accounts'] as $id => $account ) : ?>
				<option value="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $account ); ?></option>
			<?php endforeach; ?>
		<?php endif; ?>
	</select>

	<div id="queuewp-account-settings"></div>
</div>
