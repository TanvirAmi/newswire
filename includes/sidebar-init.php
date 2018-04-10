<?php

// Register Widgets
function tj_widgets_init() {
	// Sidebar
	register_sidebar( array (
		'name' => __( 'Sidebar', 'themejunkie' ),
		'id' => 'sidebar',
		'description' => __( 'Sidebar', 'themejunkie' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Home Sidebar
	register_sidebar( array (
		'name' => __( 'Home Sidebar', 'themejunkie' ),
		'id' => 'home-sidebar',
		'description' => __( 'main loop in home', 'themejunkie' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'init', 'tj_widgets_init' );

?>