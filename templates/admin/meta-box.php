<div class="social-queue-meta-box">
	<div class="social-queue-post">
		<div class="social-queue-networks">
			<ul>
				<li>
					<input type="checkbox"><span class="dashicons dashicons-twitter"></span>
				</li>
                <li>
                    <input type="checkbox"><span class="dashicons dashicons-facebook"></span>
				</li>
			</ul>
		</div>

		<div class="social-queue-description">
			<textarea placeholder="<?php esc_attr_e( 'Start typing the message you would like to share...', 'social-queue' ); ?>"></textarea>
		</div>

		<div class="social-queue-preview">
			<h3><?php esc_html_e( 'Social Media Preview', 'social-queue' ); ?></h3>
		</div>
	</div>
	<div class="social-queue-schedule">
		<h3><?php esc_html_e( 'Schedule Post', 'social-queue' ); ?></h3>

        <ul>
            <li>
                <input name="social-queue-schedule" type="radio" checked><label><?php esc_html_e( "Don't schedule", 'social-queue' ); ?></label>
            </li>
            <li>
                <input name="social-queue-schedule" type="radio"><label><?php esc_html_e( 'Automatically schedule for me', 'social-queue' ); ?></label>
            </li>
            <li>
                <input name="social-queue-schedule" type="radio"><label><?php esc_html_e( 'Let me choose the schedule', 'social-queue' ); ?></label>
            </li>
        </ul>
	</div>
</div>