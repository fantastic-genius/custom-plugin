<?php
/*
 * Plugin Name: Display Wishlist Counter
 * Description: Add wishlist counter to a widget area
 * Version: 1.0
 */

// Register and load the widget
function wpwl_load_widget() {
    register_widget( 'wpwl_widget' );
}
add_action( 'widgets_init', 'wpwl_load_widget' );
 
// Creating the widget 
class wpwl_widget extends WP_Widget {
 
public function __construct() {
parent::__construct(
 
// Base ID of your widget
'wpwl_widget', 
 
// Widget name will appear in UI
__('WPWishlist Widget', 'wwlb_widget_domain'), 
 
// Widget description
array( 'description' => __( 'Widget to Display Wish List', 'wpwl_widget_domain' ), ) 
);
}
 
// Creating widget front-end
 
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
 
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];
 
// This is where you run the code and display the output
$wishlist_count = YITH_WCWL()->count_products(); ?>
<a href="http://equinoxcollections.com/wishlist/" class="wishlist-widget"><span class="icon-yith-heart">
 </span><span class="your-counter-selector"><?php 
	echo $wishlist_count; ?></span></a><?php
}
         
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'New title', 'wpwl_widget_domain' );
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}
     
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} // Class wpwl_widget ends here
