<?php
/*
This file contains the functions and code needed to customize the Wordpress Administration area. It is broken down by which
parts it edits, and frequently lists every available setting for its section.. This is not a file intended to be implemented 
in full. Remove parts that you want to be untouched. At the bottom is a condition statement that can be used to add if user
is an editor. See comments in each section for additional notes.

Just uncomment the add_action line and add the parts you want to your functions.php file.
*/


/** ADD/REMOVE DASHBOARD WIDGETS ******************************************************/

function remove_dashboard_widgets(){
  global$wp_meta_boxes;
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']); //stats
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']); //non-installed plugin information
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); //recent comments obviously
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']); //outside source links to me
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); //WordPress Blog
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); //Other WordPress News
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']); //quick post area
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']); //recent drafts available
}

//add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

/** ADD/REMOVE TOP LEVEL ADMIN ITEMS ******************************************************/

//Available arrays put in __('foo'): Dashboard, Posts, Media, Links, Comments, Pages, Appearance, Plugins, Users, Tools, Settings
function remove_menu_items() {
  global $menu;
  $restricted = array(__('Dashboard'),__('Posts'),__('Media'),__('Links'),__('Comments'),__('Pages'),__('Appearance'),__('Plugins'),__('Users'),__('Tools'),__('Settings'));
  end ($menu);
  while (prev($menu)){
    $value = explode(' ',$menu[key($menu)][0]);
    if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){
      unset($menu[key($menu)]);}
    }
  }

//add_action('admin_menu', 'remove_menu_items');



/** ADD/REMOVE SUBMENU ITEMS ******************************************************/

//Note that the top level links still work even if there is no submenu. Needs Theme Editor removal function below too.
function remove_submenus() {
  global $submenu;

  //Dashboard menu
  unset($submenu['index.php'][10]); // Removes Updates
  //Posts menu
  unset($submenu['edit.php'][5]); // Leads to listing of available posts to edit
  unset($submenu['edit.php'][10]); // Add new post
  unset($submenu['edit.php'][15]); // Remove categories
  unset($submenu['edit.php'][16]); // Removes Post Tags
  //Media Menu
  unset($submenu['upload.php'][5]); // View the Media library
  unset($submenu['upload.php'][10]); // Add to Media library
  //Links Menu
  unset($submenu['link-manager.php'][5]); // Link manager
  unset($submenu['link-manager.php'][10]); // Add new link
  unset($submenu['link-manager.php'][15]); // Link Categories
  //Pages Menu
  unset($submenu['edit.php?post_type=page'][5]); // The Pages listing
  unset($submenu['edit.php?post_type=page'][10]); // Add New page
  //Appearance Menu
  unset($submenu['themes.php'][5]); // Removes 'Themes'
  unset($submenu['themes.php'][7]); // Widgets
  unset($submenu['themes.php'][15]); // Removes Theme Installer tab
  //Plugins Menu
  unset($submenu['plugins.php'][5]); // Plugin Manager
  unset($submenu['plugins.php'][10]); // Add New Plugins
  unset($submenu['plugins.php'][15]); // Plugin Editor
  //Users Menu
  unset($submenu['users.php'][5]); // Users list
  unset($submenu['users.php'][10]); // Add new user
  unset($submenu['users.php'][15]); // Edit your profile
  //Tools Menu
  unset($submenu['tools.php'][5]); // Tools area
  unset($submenu['tools.php'][10]); // Import
  unset($submenu['tools.php'][15]); // Export
  unset($submenu['tools.php'][20]); // Upgrade plugins and core files
  //Settings Menu
  unset($submenu['options-general.php'][10]); // General Options
  unset($submenu['options-general.php'][15]); // Writing
  unset($submenu['options-general.php'][20]); // Reading
  unset($submenu['options-general.php'][25]); // Discussion
  unset($submenu['options-general.php'][30]); // Media
  unset($submenu['options-general.php'][35]); // Privacy
  unset($submenu['options-general.php'][40]); // Permalinks
  unset($submenu['options-general.php'][45]); // Misc

}
//add_action('admin_menu', 'remove_submenus');

/** REMOVE THEME EDITOR MENU OPTION ******************************************************/

//not sure why it doesn't work with the submenu list above.
function remove_editor_menu() {
  remove_action('admin_menu', '_add_themes_utility_last', 101);
}
//add_action('_admin_menu', 'remove_editor_menu', 1);

/** UNREGISTER MOST DEFAULT WIDGETS ******************************************************/

//Only default widget remaining is the text widget
function remove_some_wp_widgets(){
  unregister_widget('WP_Widget_Archives');
  unregister_widget('WP_Widget_Calendar');
  unregister_widget('WP_Widget_Categories');
  unregister_widget('WP_Widget_Links');
  unregister_widget('WP_Widget_Meta');
  unregister_widget('WP_Widget_Pages');
  unregister_widget('WP_Widget_Recent_Comments');
  unregister_widget('WP_Widget_Recent_Posts');
  unregister_widget('WP_Widget_RSS');
  unregister_widget('WP_Widget_Search');
  unregister_widget('WP_Widget_Tag_Cloud');
  unregister_widget('WP_Nav_Menu_Widget');
}

//add_action('widgets_init', 'remove_some_wp_widgets', 1);

/** ADD/REMOVE METABOX BY POST/PAGE ID ******************************************************/

// Good for adding metaboxes based on which page you're editing. Ex. Contact page gets contact info fields & About page doesn't
// List of default metaboxes below. Add/remove custom ones as needed.
$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
if ($post_id == '##') //Get the ID that you want based on which page you want metabox to be in
	{
		add_meta_box('...');
		remove_meta_box('...');
	}

/** DEFAULT METABOXES ******************************************************/

/*The first parameter is the meta box's HTML ID attribute you want to remove. The second parameter refers to the page
you want to remove the meta box from (it can be either 'post', 'page', or 'link')
inspect the source code to determine the ID attribute value of the section's containing <div>.*/

function customize_meta_boxes() {
  /* Removes meta boxes from Posts */
  remove_meta_box('postcustom','post','normal');
  remove_meta_box('trackbacksdiv','post','normal');
  remove_meta_box('commentstatusdiv','post','normal');
  remove_meta_box('commentsdiv','post','normal');
  remove_meta_box('tagsdiv-post_tag','post','normal');
  remove_meta_box('postexcerpt','post','normal');
  /* Removes meta boxes from pages */
  remove_meta_box('postcustom','page','normal');
  remove_meta_box('trackbacksdiv','page','normal');
  remove_meta_box('commentstatusdiv','page','normal');
  remove_meta_box('commentsdiv','page','normal'); 
}
//add_action('admin_init','customize_meta_boxes');

/** EDIT DROP DOWN FIELD ALONG TOP ******************************************************/

//Defaults: post-new.php, edit.php?post_status=draft, post-new.php?post_type=page, media-new.php, edit-comments.php
//Can add too, not just limited to removing
function custom_favorite_actions($actions) {
  unset($actions['edit-comments.php']);
  unset($actions['media-new.php']);
  unset($actions['edit.php?post_status=draft']);
  unset($actions['post-new.php?post_type=post']);
  unset($actions['post-new.php?post_type=page']);
  return $actions;
}
//add_filter('favorite_actions', 'custom_favorite_actions');

/** EDIT USER ROLE CAPABILITIES ******************************************************/

 //retrieve user limits
$editor_role = get_role('editor');
//full list at http://codex.wordpress.org/Roles_and_Capabilities
$editor_role->add_cap('list_users');
$editor_role->add_cap('create_users');
$editor_role->add_cap('remove_users');
$editor_role->add_cap('promote_users');

/** DISPLAY CODE BASED ON USER ROLE ******************************************************/
if ( current_user_can('editor') ) {
	//Code goes here
}
?>
