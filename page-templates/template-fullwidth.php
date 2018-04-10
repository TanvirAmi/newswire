<?php
/*
Template Name: Full Width
*/
?>

<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				<h1 class="page-title"><?php the_title(); ?></h1>
				<div class="entry-content one-col">
					<?php the_content(''); ?>					
				</div><!-- .entry-content -->
			<?php edit_post_link('('.__('Edit', 'themejunkie').')', '<span class="entry-content-edit">', '</span>'); ?>
		
	<?php endwhile; endif; ?>
	
<?php get_footer(); ?>