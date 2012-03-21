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