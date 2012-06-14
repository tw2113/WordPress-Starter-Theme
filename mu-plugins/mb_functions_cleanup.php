<?php
/*
Plugin Name: __sitename__'s Functions Cleanup.
Plugin URI: http://michaelbox.net
Description: Basic plugin used to create Custom Post Types for the site.
Author: Michael Beckwith
Version: 2.113
*/

//Disable EditURI, WLWManifest, adjacent posts rel, and version generator
function wpst_headcleanup() {
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
	}
add_action('init', 'wpst_headcleanup');

/* adds the favicon/appleicon to the wp_head() call*/
function wpst_favicons() {
	echo '<link rel="shortcut icon" href="'.get_bloginfo('url').'/favicon.ico" />';
	echo '<link rel="apple-touch-icon" href="'.get_bloginfo('url').'/apple-touch-icon.png" />';
}
add_action('wp_head', 'wpst_favicons');