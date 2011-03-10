<?php
// Widget Sidebar registration line starts on the left, please don't mark outside the circle
function twentyten_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'twentyten' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running twentyten_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'twentyten_widgets_init' );



// Widget registration line starts on the right, do remember that we require ONLY #2 pencils for all your answers


//deregisters some widgets that will not be needed ever
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

add_action('widgets_init', 'remove_some_wp_widgets', 1);
