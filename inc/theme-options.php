<?php
add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/** Init plugin options to white list our options */
function theme_options_init(){
	register_setting( 'wpst_options', 'wpst_theme_options', 'theme_options_validate' );
}

/** Load up the menu page */
function theme_options_add_page() {
	add_theme_page( 'Theme Options', 'Theme Options', 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}

/** Create the options page */
function theme_options_do_page() {

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . ' Theme Options' . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong>Options saved</strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'wpst_options' ); ?>
			<?php $options = get_option( 'wpst_theme_options' ); ?>

			<table class="form-table">
				<tr valign="top"><th scope="row"><label for="wpst_theme_options[twitter]">Twitter ID</label></th>
					<td><span style="font-style: italic;">http://www.twitter.com/</span>
					<input id="wpst_theme_options[twitter]" class="regular-text" type="text" maxlength="45" size="25" name="wpst_theme_options[twitter]" value="<?php esc_attr_e( $options['twitter'] ); ?>"/>
					</td>
				</tr>
				<tr valign="top"><th scope="row"><label for="wpst_theme_options[facebook]">Facebook</label></th>
					<td><span style="font-style: italic;">http://www.facebook.com/</span>
					<input id="wpst_theme_options[facebook]" class="regular-text" type="text" maxlength="45" size="25" name="wpst_theme_options[facebook]" value="<?php esc_attr_e( $options['facebook'] ); ?>"/>
					</td>
				</tr>
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="Save Options" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {
	// Say our text option must be safe text with no HTML tags
	$input['twitter'] = wp_filter_nohtml_kses( $input['twitter'] );
	$input['facebook'] = wp_filter_nohtml_kses( $input['facebook'] );
	//$input['linkedin'] = wp_filter_nohtml_kses( $input['linkedin'] );

	return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/