<?php
//Uncomment out the add_actions whenever you want to add one of the functions.

// Widget Sidebar registration line starts on the left, please don't mark outside the circle
function wpst_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => 'Primary Widget Area',
		'id' => 'primary-widget-area',
		'description' => 'The primary widget area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running wpst_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'wpst_widgets_init' );

// Widget registration line starts on the right, do remember that we require ONLY #2 pencils for all your answers

//deregisters widgets
function wpst_remove_wp_widgets(){
if(is_admin()) {
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
}
add_action('widgets_init', 'wpst_remove_wp_widgets', 1);

/*
//Add a proper class name and widget name. Class name is for the extension of the WP_Widget, and for registering the widget.

class class_name extends WP_Widget {
	function class_name() {
		parent::WP_Widget(false, $name = 'enter_name');
	}

	function widget($args, $instance) {
		//Output the widget content
		extract( $args );

		$title = apply_filters('widget_title', $instance['title']);
		$the_description = $instance['the_description'];
		$the_pic = $instance['the_pic'];

		//Output to the front website goes here. Use variables defined above

	}

	function update($new_instance, $old_instance) {
		//Process and save the widget options
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['the_description'] = strip_tags($new_instance['the_description']);
		$instance['the_pic'] = strip_tags($new_instance['the_pic']);

		return $instance;
	}

	function form($instance) {
		//Output the options form in admin
		$title = $instance['title'];
		$the_description = $instance['the_description'];
		$the_pic = $instance['the_pic'];

		?>

		<!--The form that the user has to enter the data-->
	    <p>
	    <label for="<?php echo $this->get_field_id('title'); ?>">Widget Title:</label><br/>
	    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" placeholder="Title of the widget" type="text" value="<?php echo $title; ?>" />
	    </p>
	    <p>
	    <label for="<?php echo $this->get_field_id('the_wine_description'); ?>">Wine Description:</label><br/>
	    <input class="widefat" id="<?php echo $this->get_field_id('the_description'); ?>" name="<?php echo $this->get_field_name('the_description'); ?>" placeholder="" type="text" value="<?php echo $the_description; ?>" />
	    </p>
	    <p>
	    <label for="<?php echo $this->get_field_id('the_wine_pic'); ?>">Picture for the wine:</label><br/>
	    <input class="widefat" id="<?php echo $this->get_field_id('the_pic'); ?>" name="<?php echo $this->get_field_name('the_pic'); ?>" placeholder="" type="text" value="<?php echo $the_pic; ?>" />
	    </p>
    <?php }
}
register_widget('class_name');*/

?>