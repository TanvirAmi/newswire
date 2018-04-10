<?php get_header(); ?>

	<div id="content">
	
		<?php get_template_part('includes/breadcrumbs'); ?>

		<div class="archive-child">
		<?php
		$x = get_category( get_query_var( 'cat' ) );
		$y = $x->cat_ID;
		//echo $y;

		?>
		<?php
		$parent_cat_arg = array('hide_empty' => false, 'parent' => 0 );
		$parent_cat = get_terms('category',$parent_cat_arg);//category name
		$child_arg = array( 'hide_empty' => false, 'parent' => $y );
   		 	$child_cat = get_terms( 'category', $child_arg );
   		 		echo '<ul class="child-ul">';
		        foreach( $child_cat as $child_term ) {
		            echo '<li class="ar-child-cat"><a href="'.get_term_link($child_term).'">'. $child_term->name . '</a></li>';
		        }
		        echo '</ul>';
		?>
		</div>
		<?php
		$arg = array(
			'order'   => 'ASC',
			'cat' => $y,
			'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1)
		);
		$the_query = new WP_Query($arg);
		?>
		<?php if ( $the_query->have_posts()) : while ( $the_query-> have_posts() ) : $the_query->the_post() ?>


			<?php get_template_part('includes/loop'); ?>
	
		<?php endwhile; ?>
		
		<div class="clear"></div>
		
		<?php if (function_exists('wp_pagenavi')) wp_pagenavi(); else { ?>
		
			<div class="pagination">
		    	<div class="left"><?php previous_posts_link(__('Sau', 'themejunkie')) ?></div>
		   		<div class="right"><?php next_posts_link(__('Trước', 'themejunkie')) ?></div>
		    	<div class="clear"></div>
			</div> <!-- .pagination -->
			
		<?php } ?> 
		
		<?php else : ?>
		
		<?php endif; ?>
		
	</div> <!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
