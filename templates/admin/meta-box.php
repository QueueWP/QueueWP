<div id="social-queue-meta-box">
	<div class="social-queue-details">
        <div class="social-queue-post">
            <div class="social-queue-selector">
                <div class="social-queue-networks">
                    <ul>
                        <li>
                            <input name="social-queue-network" type="checkbox"><span class="dashicons dashicons-twitter"></span>
                        </li>
                        <li>
                            <input name="social-queue-network" type="checkbox"><span class="dashicons dashicons-facebook"></span>
                        </li>
                    </ul>
                </div>
                <div class="social-queue-count">
                    <p><span>0</span>/140</p>
                </div>
            </div>

            <div class="social-queue-message">
                <textarea name="social-queue-message" placeholder="<?php esc_attr_e( 'Start typing the message that you would like to share...', 'social-queue' ); ?>"></textarea>
            </div>

            <div class="social-queue-actions">
                <ul>
                    <li><a href="#" class="button social-queue-choose-image"><?php esc_html_e( 'Choose Image', 'social-queue' ); ?></a></li>
                    <li><a href="#" class="button social-queue-edit"><?php esc_html_e( 'Edit Title / Description', 'social-queue' ); ?></a></li>
                </ul>

                <div class="social-queue-custom-content">
                    <label for=""><?php esc_html_e( 'Title', 'social-queue' ); ?></label>
                    <input name="social-queue-title" type="text" class="large-text" />

                    <label for=""><?php esc_html_e( 'Description', 'social-queue' ); ?></label>
                    <textarea name="social-queue-description" class="large-text"></textarea>

                    <label for=""><?php esc_html_e( 'Image', 'social-queue' ); ?></label>
                    <input name="social-queue-image" type="text" class="large-text" />
                </div>
            </div>
        </div>
        <div class="social-queue-schedule">
            <h3><?php esc_html_e( 'Schedule Post', 'social-queue' ); ?></h3>

            <ul>
                <li>
                    <label for="social-queue-schedule"><input name="social-queue-schedule" class="social-queue-schedule-no-action" type="radio" checked><?php esc_html_e( "Don't schedule", 'social-queue' ); ?></label>
                </li>
                <li>
                    <label for="social-queue-schedule"><input name="social-queue-schedule" class="social-queue-schedule-automatic-action" type="radio"><?php esc_html_e( 'Automatically schedule for me', 'social-queue' ); ?></label>

                    <div class="social-queue-schedule-automatic">
                        <label for="social-queue-automatic-count">
                            <input name="social-queue-automatic-count" type="number" min="0" step="1" class="small-text" value="1" /> <?php esc_html_e( 'How many times would you like this post to be shared?', 'social-queue' ); ?>
                        </label>
                    </div>
                </li>
                <li>
                    <label for="social-queue-schedule"><input name="social-queue-schedule" class="social-queue-schedule-manual-action" type="radio"><?php esc_html_e( 'Let me choose the schedule', 'social-queue' ); ?></label>

                    <div class="social-queue-schedule-manual">
                        <div class="social-queue-schedule-item">
                            <fieldset id="timestampdiv">
                                <?php \Social_Queue\Social_Queue::get()->utility->template->load( 'admin/parts/timestamp.php' ); ?>
                            </fieldset>
                        </div>

                        <a href="#" class="social-queue-add-schedule-item"><span class="dashicons dashicons-plus-alt"></span> Add new day/time for posting</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="social-queue-preview">
        <h3><?php esc_html_e( 'Social Media Preview', 'social-queue' ); ?></h3>

        <div class="social-queue-preview-box">
            <div class="social-queue-preview-image">
                <img src="" />
            </div>

            <div class="social-queue-preview-content">
                <h3>Title of the current post being edited</h3>
                <p class="social-queue-url">https://social.dev</p>
                <p>This is a preview of the description that will show up in the preview pane and will be viewable before we post to social.</p>
            </div>
        </div>
    </div>
</div>