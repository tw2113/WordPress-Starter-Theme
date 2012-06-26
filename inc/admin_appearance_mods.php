<?php
/*
This file holds WordPress actions and filters that alter Admin areas.
Remove comment //'s in front of the add_action() lines to activate
*/

//Custom CSS for the WordPress login page
function wpst_custom_login() {
echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_directory').'/css/custom-login.css" />';
}
//add_action('login_head', 'wpst_custom_login');

//Customize Admin footer text
function wpst_remove_footer_admin () {
    echo "You look very nice today.";
}
//add_filter('admin_footer_text', 'wpst_remove_footer_admin');

//Adds custom field to user profile for avatar setting. Repeat as necessary for extra fields.
function wpst_my_show_extra_profile_fields( $user ) { ?>
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
//add_action( 'show_user_profile', 'wpst_my_show_extra_profile_fields' );
//add_action( 'edit_user_profile', 'wpst_my_show_extra_profile_fields' );

function wpst_my_save_extra_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;
	update_usermeta( $user_id, 'avatar', $_POST['avatar'] );
}
//add_action( 'personal_options_update', 'wpst_my_save_extra_profile_fields' );
//add_action( 'edit_user_profile_update', 'wpst_my_save_extra_profile_fields' );

/** Usage in template files **************
echo get_the_author_meta('avatar', $user_id); */

/*
Instructions:

Adding:
Note that the second and third of $admin_bar->add_menu are add sub menu to the first, and the parent parameter is set to the id of the first $admin_bar->add_menu, which in this case is my-item.
Removing:
$admin_bar->remove_menu( 'slug' );
For example you can remove the WordPress logo by using : $admin_bar->remove_menu( 'wp-logo' );
*/

//add_action('admin_bar_menu', 'wpst_add_toolbar_items', 100);
function wpst_add_toolbar_items($admin_bar){
	$admin_bar->add_menu( array(
		'id'    => 'my-item',
		'title' => 'My Item',
		'href'  => '#',
		'meta'  => array(
			'title' => __('My Item'),
		),
	));
	$admin_bar->add_menu( array(
		'id'    => 'my-sub-item',
		'parent' => 'my-item',
		'title' => 'My Sub Menu Item',
		'href'  => '#',
		'meta'  => array(
			'title' => __('My Sub Menu Item'),
			'target' => '_blank',
			'class' => 'my_menu_item_class'
		),
	));
	$admin_bar->add_menu( array(
		'id'    => 'my-second-sub-item',
		'parent' => 'my-item',
		'title' => 'My Second Sub Menu Item',
		'href'  => '#',
		'meta'  => array(
			'title' => __('My Second Sub Menu Item'),
			'target' => '_blank',
			'class' => 'my_menu_item_class'
		),
	));
}
// Change the "Posts" menu item to "Blog" or whatever you want
function wpst_change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Blog';
    $submenu['edit.php'][5][0] = 'Posts';
    $submenu['edit.php'][10][0] = 'Add Post';
    $submenu['edit.php'][15][0] = 'Categories'; // Change name for categories
    $submenu['edit.php'][16][0] = 'Tags'; // Change name for tags
    echo '';
}
//add_action( 'admin_menu', 'wpst_change_post_menu_label' );

//Change text inside the post/page editor title field. Should be able to adapt as necessary.
function title_text_input( $title ){
	global $post;
	return (($post->post_type == 'page') ? 'Foo' : 'Bar');
}
//add_filter( 'enter_title_here', 'title_text_input' );