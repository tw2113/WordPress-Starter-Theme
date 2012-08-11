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
	register_post_type( 'testimonials',
		array(
			'labels' => array(
			'name' => __( 'Testimonials' ),
			'singular_name' => __( 'Testimonial' ),
			'add_new' => __( 'New Testimonial' ),
			'add_new_item' => __( 'Add New Testimonial' ),
			'edit' => __( 'Change' ),
			'edit_item' => __( 'Change the Testimonial' ),
			'new_item' => __( 'A New Testimonial' ),
			'view' => __( 'See' ),
			'view_item' => __( 'See the Testimonial' ),
			'search_items' => __( 'Search Testimonials' ),
			'not_found' => __( 'No Testimonial to display' ),
			'not_found_in_trash' => __( 'No Testimonials discarded' ),
			'parent' => __( 'Parent Testimonial' ),
			'_builtin' => false, // It's a custom post type, not built in!
			'rewrite' => array('slug' => 'testimonial', 'with_front' => FALSE), // Permalinks format
			),
			'public' => true,
			'show_ui' => true,
			'description' => __( 'Testimonials for displaying your work' ),
			'query_var' => true,
			'supports' => array( 'title', 'editor', 'custom-fields', 'thumbnail' ),
			//'menu_icon' => get_stylesheet_directory_uri() . '/images/images_icon.png',
		)
	);
}
