<h1>SimpleStage Web Tools</h1>
<form action="options.php" method="post">
	<?php
	settings_fields( 'simplestage_settings' );
	do_settings_sections( __FILE__ );
	$options = get_option( 'simplestage_settings' );
	?>

	<table class="form-table">
		<tbody>
		<tr>
			<th scope="row">
				<label for="simplestage-enable">Enable Web Script</label>
			</th>
			<td>
				<input id="simplestage-enable" type="checkbox" name="simplestage_settings[enabled]" <?php echo ( isset( $options[ 'enabled' ] ) && $options[ 'enabled' ] === 'on' ) ? 'checked' : ''; ?> />
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="simplestage-key">Web Request API Key</label>
			</th>
			<td>
				<input id="simplestage-key" type="text" name="simplestage_settings[key]" value="<?php echo ( isset( $options[ 'key' ] ) && $options[ 'key' ] != '' ) ? esc_attr($options[ 'key' ]) : ''; ?>"/>
				<br>
				<span class="description"></span>
			</td>
		</tr>
		</tbody>
	</table>
	<p class="submit"><input type="submit" value="Save Settings" class="button-primary" name="Submit"></p>
</form>
