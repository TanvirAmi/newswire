<?php get_header(); ?>

<div id="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<h1 class="page-title"><?php the_title(); ?></h1>
		
		<div class="entry-content">
			<?php the_content(''); ?>
		</div><!-- .entry-content -->
		
		<div class="clear"></div>
		
		<?php edit_post_link('[ '.__('Edit', 'themejunkie').' ]', '', ''); ?>
	
		<?php if(get_option('newswire_show_page_comments') == 'on') { ?>
			<?php comments_template('', true);  ?> 	
	  	<?php } ?>  

	<?php endwhile; ?>
	
	<?php else : ?>
	
	<?php endif; ?>

</div><!-- #content -->
    
<?php get_sidebar(); ?>
<?php get_footer(); ?>