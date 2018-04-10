<div id="featured-content">

	<div class="featured-left">
    		<?php						
			query_posts( array(
				'showposts' => 1,
				'tag' => get_option('newswire_featured_post_tags'),
			) );
			if( have_posts() ) : while( have_posts() ) : the_post();
		?>
    	
    		<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('large-thumb', array('class' => 'entry-thumb')); ?></a>
	    		
    		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

  			<div class="entry-meta">
  				<span class="entry-date"><?php the_time('M jS, Y') ?></span><span class="entry-comment"> &middot; <?php comments_popup_link( __( '0 Comment', 'themejunkie' ), __( '1 Comment', 'themejunkie' ), __( '% Comments', 'themejunkie' ) ); ?></span>
  			</div><!-- .entry-meta -->    		
    		
    		<div class="entry-excerpt">
    			<?php tj_content_limit(get_option('newswire_left_featured_char_num','themejunkie')); ?>
    		</div><!-- .entry-excerpt -->
    	<?php endwhile; endif; wp_reset_query(); ?>
    	
  	</div><!-- .featured-left -->
  
  	<div class="featured-right">
  	
		<?php
			$post_count = 1;		                
	         query_posts( array(
                 'showposts' => get_option('newswire_featured_post_num'),
                 'offset' => 1,
                 'tag' => get_option('newswire_featured_post_tags'),
	         ) );
	         if( have_posts() ) : while( have_posts() ) : the_post();
		 ?>
		 
		 <div class="featuredpost<?php if ($post_count == get_option('newswire_featured_post_num')) { echo ' featured-post-last'; } ?>">
    		     			
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('small-thumb', array('class' => 'entry-thumb')); ?></a>
	 		     			
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				
			<div class="entry-meta">
  				<span class="entry-date"><?php the_time('M jS, Y') ?></span><span class="entry-comment"> &middot; <?php comments_popup_link( __( '0 Comment', 'themejunkie' ), __( '1 Comment', 'themejunkie' ), __( '% Comments', 'themejunkie' ) ); ?></span>
			</div><!-- .entry-meta -->
				
			<div class="entry-excerpt">
				<?php tj_content_limit(get_option('newswire_right_featured_char_num','themejunkie')); ?>
			</div><!-- .entry-excerpt -->
				
			<div class="clear"></div>
      		
    	</div><!-- .featuredpost -->
    
    	<?php $post_count++; endwhile; endif; wp_reset_query(); ?>
    	
    </div><!-- .featured-right -->
    
    <div class="clear"></div> 
  
</div><!-- #featured-content -->

<div class="clear"></div>