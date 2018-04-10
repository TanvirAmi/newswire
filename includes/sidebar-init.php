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

	// after child category in the category archive page
	register_sidebar( array (
		'name' => __( 'Category Archive', 'themejunkie' ),
		'id' => 'archive-sidebar',
		'description' => __( 'after child category in category archive', 'themejunkie' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'init', 'tj_widgets_init' );

?>