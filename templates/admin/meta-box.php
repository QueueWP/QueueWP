<div class="social-queue-meta-box">
	<div class="social-queue-details">
        <div class="social-queue-post">
            <div class="social-queue-selector">
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
                <div class="social-queue-count">
                    <p>0/140</p>
                </div>
            </div>

            <div class="social-queue-message">
                <textarea placeholder="<?php esc_attr_e( 'Start typing the message that you would like to share...', 'social-queue' ); ?>"></textarea>
            </div>

            <div class="social-queue-actions">
                <ul>
                    <li><a href="#" class="button"><?php esc_html_e( 'Choose Image', 'social-queue' ); ?></a></li>
                    <li><a href="#" class="button"><?php esc_html_e( 'Edit Title / Description', 'social-queue' ); ?></a></li>
                </ul>

                <div class="social-queue-custom-content">
                    <label for=""><?php esc_html_e( 'Title', 'social-queue' ); ?></label>
                    <input type="text" class="large-text" />

                    <label for=""><?php esc_html_e( 'Description', 'social-queue' ); ?></label>
                    <textarea class="large-text"></textarea>

                    <label for=""><?php esc_html_e( 'Image', 'social-queue' ); ?></label>
                    <input type="text" class="large-text" />
                </div>
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

                    <div class="social-queue-schedule-automatic">
                        <label for="">
                            <input type="number" min="0" step="1" class="small-text" value="1" /> <?php esc_html_e( 'How many times would you like this post to be shared?', 'social-queue' ); ?>
                        </label>
                    </div>
                </li>
                <li>
                    <input name="social-queue-schedule" type="radio"><label><?php esc_html_e( 'Let me choose the schedule', 'social-queue' ); ?></label>

                    <div class="social-queue-schedule-manual">
                        <div class="social-queue-schedule-item">
                            <fieldset id="timestampdiv">
                                <div class="timestamp-wrap">
                                    <label>
                                        <span class="screen-reader-text">Month</span>
                                        <select id="mm" name="mm">
                                            <option value="01" data-text="Jan">01-Jan</option>
                                            <option value="02" data-text="Feb" selected="selected">02-Feb</option>
                                            <option value="03" data-text="Mar">03-Mar</option>
                                            <option value="04" data-text="Apr">04-Apr</option>
                                            <option value="05" data-text="May">05-May</option>
                                            <option value="06" data-text="Jun">06-Jun</option>
                                            <option value="07" data-text="Jul">07-Jul</option>
                                            <option value="08" data-text="Aug">08-Aug</option>
                                            <option value="09" data-text="Sep">09-Sep</option>
                                            <option value="10" data-text="Oct">10-Oct</option>
                                            <option value="11" data-text="Nov">11-Nov</option>
                                            <option value="12" data-text="Dec">12-Dec</option>
                                        </select>
                                    </label>
                                    <label>
                                        <span class="screen-reader-text">Day</span>
                                        <input type="text" id="jj" name="jj" value="08" size="2" maxlength="2" autocomplete="off"></label>,
                                    <label>
                                        <span class="screen-reader-text">Year</span>
                                        <input type="text" id="aa" name="aa" value="2017" size="4" maxlength="4" autocomplete="off">
                                    </label>
                                    @
                                    <label>
                                        <span class="screen-reader-text">Hour</span>
                                        <input type="text" id="hh" name="hh" value="17" size="2" maxlength="2" autocomplete="off">
                                    </label>
                                    :
                                    <label>
                                        <span class="screen-reader-text">Minute</span>
                                        <input type="text" id="mn" name="mn" value="53" size="2" maxlength="2" autocomplete="off">
                                    </label>
                                    <span class="dashicons dashicons-dismiss"></span>
                                </div>
                            </fieldset>
                        </div>

                        <a href="#"><span class="dashicons dashicons-plus-alt"></span> Add new day/time for posting</a>
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