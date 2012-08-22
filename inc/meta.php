<?php
add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
function cmb_initialize_cmb_meta_boxes() {
	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once( get_template_directory() . '/meta/init.php');
}
$prefix = '_'; // Prefix for all fields
function NAME_quote_metaboxes( $meta_boxes ) {
	global $prefix;
	$meta_boxes[] = array(

	);
	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'NAME_quote_metaboxes' );