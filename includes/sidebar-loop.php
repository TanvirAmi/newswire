<h3>
<a href="<?php echo get_category_link(get_cat_ID(get_option('newswire_sidebar_loop_cat'))); ?>" rel="bookmark"><?php echo cat_id_to_name(get_cat_ID(get_option('newswire_sidebar_loop_cat'))); ?></a>
</h3>
			<ul class="sidebar-loop">
			
			  <?php
			    query_posts( array(
			        'showposts' => get_option('newswire_sidebar_loop_num'),
			        'cat' => get_cat_ID(get_option('newswire_sidebar_loop_cat'))
			    ) );
			    if( have_posts() ) : while( have_posts() ) : the_post();
			?>

			  <li>
			 <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('sidebar-thumb', array('class' => 'entry-thumb')); ?></a>
			  
			  <div class="info">
		<a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
		<span class="meta"><?php the_time('M jS, Y'); ?></span>
		<?php tj_content_limit(get_option('newswire_sidebar_loop_char_num','themejunkie')); ?>
		</div> <!--end .info-->
                          </li>
			 <?php endwhile; endif; wp_reset_query(); ?>
			  
			</ul><!--end .sidebar-loop-->
			
			<div class="clear"></div>