<?php get_header();  ?>

<div id="content">

	<?php if(get_option('newswire_featured_content_enable') == 'on' & have_posts()) { 		
		get_template_part('includes/home-featured');
	} ?>
	
	<?php if( get_option('newswire_featured_ad_enable') == 'on') {
		echo "<div class='featured-ad'>";
			echo get_option('newswire_featured_ad_code');
		echo "</div><!-- .featured-ad -->";
	} ?>		
	<?php	//get_template_part('includes/insider-loop/row-1'); ?>
	<div class="two-column-boxes">
	<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('home-sidebar') ) :?>
	<?php endif; ?>
	</div>
	<?php	//get_template_part('includes/home-loop'); ?>

	
	<?php if(get_option('newswire_bottom_content_enable') == 'on') { ?>
		<?php get_template_part('includes/home-bottom'); ?>
	<?php } ?>

</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>