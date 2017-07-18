<div class="timestamp-wrap">
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Month', 'queuewp' ); ?></span>
		<select id="mm" name="mm">
			<option value="01" data-text="Jan">01-Jan</option>
			<option value="02" data-text="Feb">02-Feb</option>
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
		<span class="screen-reader-text"><?php esc_html_e( 'Day', 'queuewp' ); ?></span>
		<input type="text" id="jj" name="jj" value="08" size="2" maxlength="2" autocomplete="off"></label>,
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Year', 'queuewp' ); ?></span>
		<input type="text" id="aa" name="aa" value="2017" size="4" maxlength="4" autocomplete="off">
	</label>
	@
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Hour', 'queuewp' ); ?></span>
		<input type="text" id="hh" name="hh" value="17" size="2" maxlength="2" autocomplete="off">
	</label>
	:
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Minute', 'queuewp' ); ?></span>
		<input type="text" id="mn" name="mn" value="53" size="2" maxlength="2" autocomplete="off">
	</label>
	<span class="dashicons dashicons-dismiss"></span>
</div>
