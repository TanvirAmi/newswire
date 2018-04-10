<?php

/* sets predefined Post Thumbnail dimensions */

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	
	//default thumbnail size
        add_image_size( 'large-thumb', 300, 340, true );
        add_image_size( 'small-thumb', 80, 80, true );		
        add_image_size( 'entry-thumb', 100, 100, true );
        add_image_size( 'bottom-thumb', 280, 120, true );
        add_image_size( 'sidebar-thumb', 120, 80, true );
};

// NOTE: You need to regenerate all thumbnails if you modified the default thumbnails size
// Regenerate Thumbnails Plugin: http://wordpress.org/extend/plugins/regenerate-thumbnails/

?>