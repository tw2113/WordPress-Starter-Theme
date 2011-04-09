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

//Widget declaration for the featured wine area of the frontpage
// Widget declaration copied from previous website project that sells wine. Edit as needed
/*
class jcFeaturedwine extends WP_Widget {
	function jcFeaturedwine() {
		parent::WP_Widget(false, $name = 'jcFeaturedwine');	
	}
	
	function widget($args, $instance) {
		//Output the widget content
		extract( $args );

		$title = apply_filters('widget_title', $instance['title']);
		$the_wine_description = $instance['the_wine_description'];
		$the_wine_pic = $instance['the_wine_pic'];
		$the_wine_price = $instance['the_wine_price'];
		$the_ordernow_link = $instance['the_ordernow_link'];

		echo '<div id="featuredwine">
		<img src="'.$the_wine_pic.'" alt="Our featured wine" />
		<p class="featuredline">Featured Wine:<br/>
		<p class="featured_description">'.$the_wine_description.'</p>
		<p class="featured_price">'.$the_wine_price.'</p>
		<p class="ordernow"><a href="'.$the_ordernow_link.'" title="Order this wine now">Order now</a></p>
		</div>';
	}
	
	function update($new_instance, $old_instance) {
		//Process and save the widget options
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['the_wine_description'] = strip_tags($new_instance['the_wine_description']);
		$instance['the_wine_pic'] = strip_tags($new_instance['the_wine_pic']);
		$instance['the_wine_price'] = strip_tags($new_instance['the_wine_price']);
		$instance['the_ordernow_link'] = strip_tags($new_instance['the_ordernow_link']);
		
		return $instance;
	}
	
	function form($instance) {
		//Output the options form in admin
		$title = $instance['title'];
		$the_wine_description = $instance['the_wine_description'];
		$the_wine_pic = $instance['the_wine_pic'];
		$the_wine_price = $instance['the_wine_price'];
		$the_ordernow_link = $instance['the_ordernow_link'];
		?>
		
		<!--The form that the user has to enter the data-->
	<p><label for="<?php echo $this->get_field_id('title'); ?>">Widget Title:<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" placeholder="Title of the widget" type="text" value="<?php echo $title; ?>" /></label></p>
	<p><label for="<?php echo $this->get_field_id('the_wine_description'); ?>">Wine Description:<input class="widefat" id="<?php echo $this->get_field_id('the_wine_description'); ?>" name="<?php echo $this->get_field_name('the_wine_description'); ?>" placeholder="What type of wine is featured?" type="text" value="<?php echo $the_wine_description; ?>" /></label></p>
	<p><label for="<?php echo $this->get_field_id('the_wine_pic'); ?>">Picture for the wine:<input class="widefat" id="<?php echo $this->get_field_id('the_wine_pic'); ?>" name="<?php echo $this->get_field_name('the_wine_pic'); ?>" placeholder="Ooh a pretty bottle!" type="text" value="<?php echo $the_wine_pic; ?>" /></label></p>
	<p><label for="<?php echo $this->get_field_id('the_wine_price'); ?>">Price for the wine:<input class="widefat" id="<?php echo $this->get_field_id('the_wine_price'); ?>" name="<?php echo $this->get_field_name('the_wine_price'); ?>" placeholder="How much is it going to cost me?" type="text" value="<?php echo $the_wine_price; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('the_ordernow_link'); ?>">Link to inside the store:<input class="widefat" id="<?php echo $this->get_field_id('the_ordernow_link'); ?>" name="<?php echo $this->get_field_name('the_ordernow_link'); ?>" placeholder="Direct me to the wine in the store" type="text" value="<?php echo $the_ordernow_link; ?>" /></label></p>
		
	<?php }
}
register_widget('jcFeaturedWine');*/

?>
