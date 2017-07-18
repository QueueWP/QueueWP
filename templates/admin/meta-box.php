<div id="queuewp-meta-box">
	<div class="queuewp-details">
        <div class="queuewp-post">
            <div class="queuewp-selector">
                <div class="queuewp-networks">
                    <ul>
                        <li>
                            <input name="queuewp-network" type="checkbox"><span class="dashicons dashicons-twitter"></span>
                        </li>
                        <li>
                            <input name="queuewp-network" type="checkbox"><span class="dashicons dashicons-facebook"></span>
                        </li>
                    </ul>
                </div>
                <div class="queuewp-count">
                    <p><span>0</span>/140</p>
                </div>
            </div>

            <div class="queuewp-message">
                <textarea name="queuewp-message" placeholder="<?php esc_attr_e( 'Start typing the message that you would like to share...', 'queuewp' ); ?>"></textarea>
            </div>

            <div class="queuewp-actions">
                <ul>
                    <li><a href="#" class="button queuewp-choose-image"><?php esc_html_e( 'Choose Image', 'queuewp' ); ?></a></li>
                    <li><a href="#" class="button queuewp-edit"><?php esc_html_e( 'Edit Title / Description', 'queuewp' ); ?></a></li>
                </ul>

                <div class="queuewp-custom-content">
                    <label for=""><?php esc_html_e( 'Title', 'queuewp' ); ?></label>
                    <input name="queuewp-title" type="text" class="large-text" />

                    <label for=""><?php esc_html_e( 'Description', 'queuewp' ); ?></label>
                    <textarea name="queuewp-description" class="large-text"></textarea>

                    <label for=""><?php esc_html_e( 'Image', 'queuewp' ); ?></label>
                    <input name="queuewp-image" type="text" class="large-text" />
                </div>
            </div>
        </div>
        <div class="queuewp-schedule">
            <h3><?php esc_html_e( 'Schedule Post', 'queuewp' ); ?></h3>

            <ul>
                <li>
                    <label for="queuewp-schedule"><input name="queuewp-schedule" class="queuewp-schedule-no-action" type="radio" checked><?php esc_html_e( "Don't schedule", 'queuewp' ); ?></label>
                </li>
                <li>
                    <label for="queuewp-schedule"><input name="queuewp-schedule" class="queuewp-schedule-automatic-action" type="radio"><?php esc_html_e( 'Automatically schedule for me', 'queuewp' ); ?></label>

                    <div class="queuewp-schedule-automatic">
                        <label for="queuewp-automatic-count">
                            <input name="queuewp-automatic-count" type="number" min="0" step="1" class="small-text" value="1" /> <?php esc_html_e( 'How many times would you like this post to be shared?', 'queuewp' ); ?>
                        </label>
                    </div>
                </li>
                <li>
                    <label for="queuewp-schedule"><input name="queuewp-schedule" class="queuewp-schedule-manual-action" type="radio"><?php esc_html_e( 'Let me choose the schedule', 'queuewp' ); ?></label>

                    <div class="queuewp-schedule-manual">
                        <div class="queuewp-schedule-item">
                            <fieldset id="timestampdiv">
                                <?php \QueueWP\QueueWP::get()->utility->template->load( 'admin/parts/timestamp.php' ); ?>
                            </fieldset>
                        </div>

                        <a href="#" class="queuewp-add-schedule-item"><span class="dashicons dashicons-plus-alt"></span> Add new day/time for posting</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="queuewp-preview">
        <h3><?php esc_html_e( 'Social Media Preview', 'queuewp' ); ?></h3>

        <div class="queuewp-preview-box">
            <div class="queuewp-preview-image">
                <img src="" />
            </div>

            <div class="queuewp-preview-content">
                <h3>Title of the current post being edited</h3>
                <p class="queuewp-url">https://social.dev</p>
                <p>This is a preview of the description that will show up in the preview pane and will be viewable before we post to social.</p>
            </div>
        </div>
    </div>
</div>