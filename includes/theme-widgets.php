<?php

/*---------------------------------------------------------------------------------*/
/* Loads all the .php files found in /includes/widgets/ directory */
/*---------------------------------------------------------------------------------*/

require trailingslashit( get_template_directory() ) . 'includes/widgets/widget-ad125.php';
require trailingslashit( get_template_directory() ) . 'includes/widgets/widget-ads.php';
require trailingslashit( get_template_directory() ) . 'includes/widgets/widget-category-posts.php';
require trailingslashit( get_template_directory() ) . 'includes/widgets/widget-flickr.php';
require trailingslashit( get_template_directory() ) . 'includes/widgets/widget-social.php';
require trailingslashit( get_template_directory() ) . 'includes/widgets/widget-twitter.php';
require trailingslashit( get_template_directory() ) . 'includes/widgets/widget-video.php';
require trailingslashit( get_template_directory() ) . 'includes/widgets/home-2-col.php';
	
/*---------------------------------------------------------------------------------*/
/* Deregister Default Widgets */
/*---------------------------------------------------------------------------------*/
if (!function_exists('tj_deregister_widgets')) {
	function tj_deregister_widgets(){
	    unregister_widget('WP_Widget_Search');
	}
}
// add_action('widgets_init', 'tj_deregister_widgets');


?>