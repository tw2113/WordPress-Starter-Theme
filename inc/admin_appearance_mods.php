<?php
/*
This file holds WordPress actions and filters that alter Admin areas.

Comment out the add_action() lines to activate
*/

//Custom CSS for the WordPress login page
function custom_login() {
echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_directory').'/css/custom-login.css" />';
}
//add_action('login_head', 'custom_login');

 //Customize Admin footer text
function wpst_remove_footer_admin () {
    echo "You look very nice today.";
}
//add_filter('admin_footer_text', 'wpst_remove_footer_admin');

//Adds custom field to user profile for avatar setting. Repeat as necessary for extra fields.
function my_show_extra_profile_fields( $user ) { ?>
	<h3>Extra profile information</h3>
	<table class="form-table">
		<tr>
			<th><label for="avatar">User Avatar url</label></th>
			<td>
				<input type="text" name="avatar" id="avatar" value="<?php echo esc_attr( get_the_author_meta( 'avatar', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter the url for your user avatar.</span>
			</td>
		</tr>
	</table>
<?php }
//add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
//add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;
	update_usermeta( $user_id, 'avatar', $_POST['avatar'] );
}
//add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
//add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

/** Usage in template files **************/
//echo get_the_author_meta('avatar', $user_id);