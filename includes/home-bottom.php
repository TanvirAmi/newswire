<div class="bottom-col-boxes">

	<div class="bottom-box left">
	
		<?php
			    query_posts( array(
			        'showposts' => 1,
			        'cat' => get_cat_ID(get_option('newswire_bottom_left_cat'))
			    ) );
			    if( have_posts() ) : while( have_posts() ) : the_post();
			?>
		
			<h3><a href="<?php echo get_category_link(get_cat_ID(get_option('newswire_bottom_left_cat'))); ?>" rel="bookmark"><?php echo cat_id_to_name(get_cat_ID(get_option('newswire_bottom_left_cat'))); ?></a></h3>
			
			<div class="bottom-box-wrap">
			
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('bottom-thumb', array('class' => 'entry-thumb')); ?></a>
				
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				
				<?php tj_content_limit(get_option('newswire_bottom_left_char_num','themejunkie')); ?>
				
			</div><!--end .bottom-box-wrap-->
			
		 <?php endwhile; endif; wp_reset_query(); ?>
		
	</div><!--end .bottom-box-->
	
	<div class="bottom-box right">
	
		<h3><a href="<?php echo get_category_link(get_cat_ID(get_option('newswire_bottom_right_cat'))); ?>" rel="bookmark"><?php echo cat_id_to_name(get_cat_ID(get_option('newswire_bottom_right_cat'))); ?></a></h3>
		
		<div class="bottom-box-wrap">
		
			<?php
			    query_posts( array(
			        'showposts' => 1,
			        'cat' => get_cat_ID(get_option('newswire_bottom_right_cat'))
			    ) );
			    if( have_posts() ) : while( have_posts() ) : the_post();
			?>
			
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				
				<div class="entry-excerpt"><?php tj_content_limit(get_option('newswire_bottom_right_char_num','themejunkie')); ?></div>
				
			<?php endwhile; endif; wp_reset_query(); ?>
			
			<ul>
				<?php
			    query_posts( array(
			        'showposts' => get_option('newswire_bottom_right_num'),
                                'offset' => 1,
			        'cat' => get_cat_ID(get_option('newswire_bottom_right_cat'))
			    ) );
			    if( have_posts() ) : while( have_posts() ) : the_post();
			?>
					<li class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
				<?php endwhile; endif; wp_reset_query(); ?>
			</ul>
			
		</div><!--end .bottom-box-wrap-->
		
	</div><!--end .bottom-box-->
	
</div><!--end .bottom-col-boxes -->

<div class="clear"></div>
