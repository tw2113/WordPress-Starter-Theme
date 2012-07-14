<?php
/*
Plugin Name: __sitename__'s Custom Post Types Plugin
Plugin URI: http://michaelbox.net
Description: Basic plugin used to create Custom Post Types for the site.
Author: Michael Beckwith
Version: 2.113
*/

add_action( 'init', 'wpst_create_my_post_types' );

function wpst_create_my_post_types() {
	register_post_type( 'GALLERY',
		array(
			'labels' => array(
			'name' => __( 'Galleries' ),
			'singular_name' => __( 'Gallery' ),
			'add_new' => __( 'New Gallery' ),
			'add_new_item' => __( 'Add New Gallery' ),
			'edit' => __( 'Change' ),
			'edit_item' => __( 'Change the Gallery' ),
			'new_item' => __( 'A New Gallery' ),
			'view' => __( 'See' ),
			'view_item' => __( 'See the Gallery' ),
			'search_items' => __( 'Search Galleries' ),
			'not_found' => __( 'No Gallery to display' ),
			'not_found_in_trash' => __( 'No Galleries discarded' ),
			'parent' => __( 'Parent Gallery' ),
			'_builtin' => false, // It's a custom post type, not built in!
			'rewrite' => array('slug' => 'gallery', 'with_front' => FALSE), // Permalinks format
			),
			'public' => true,
			'show_ui' => true,
			'description' => __( 'Galleries for displaying your work' ),
			'query_var' => true,
			'supports' => array( 'title', 'editor', 'custom-fields', 'thumbnail' ),
			//'menu_icon' => get_stylesheet_directory_uri() . '/images/images_icon.png',
		)
	);
}
