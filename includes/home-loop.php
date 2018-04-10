<div class="two-column-boxes">

	<?php 
		if (get_option('newswire_twocol_cats') <> '') $exclude_twocol_cats = implode(",", get_option('newswire_twocol_cats')); 
       
		$args = "orderby=".get_option('newswire_sort_cat');

		if ( isset( $exclude_twocol_cats ) ) $args .= "&exclude=".$exclude_twocol_cats;

		$categories = get_categories($args);
		$catcount = 0;
		$parent_cat_arg = array('hide_empty' => false, 'parent' => 0 );
		$parent_cat = get_terms('category',$parent_cat_arg);//category name
		echo '<div class="category-box-row clear">';
	    foreach ($categories as $cat) {
			echo '<div id="category-box2-'.$catcount.'" class="category-box';
			if(is_int($catcount/2)) echo ' category-box-even'; else echo ' category-box-odd';
			echo '">';
			
			echo '<span class="category-box-feed"><a href="'.get_category_feed_link($cat->cat_ID, '').'" title="';
			printf(__('Subscribe to %s','themejunkie'),$cat->cat_name);
			echo '">';
			printf(__('Subscribe to %s','themejunkie'),$cat->cat_name);
			echo '</a></span>';
			
			echo '<h3 class="category-box-title"><a href="'.get_category_link($cat->cat_ID).'" title="View all posts under '.$cat->cat_name.'">'.$cat->cat_name.'</a></h3>';
			echo '<div class="sub-cat">';
			$child_arg = array( 'hide_empty' => false, 'parent' => $cat->term_id );
   		 	$child_cat = get_terms( 'category', $child_arg );

		        foreach( $child_cat as $child_term ) {
		            //echo '<li>'.get_term_link($child_term). '</li>'; //Child Category
		            //echo $child_term->name;
		           echo '<li class="child-cat"><a href="'.get_term_link($child_term).'">'. $child_term->name . '</a></li>';
		        }
		   echo '</div>';
			
			echo '<ul>';
	        query_posts('showposts='.get_option('newswire_twocol_post_num').'&cat='.$cat->cat_ID);
	        $postcount = 0;
	        while (have_posts()) : the_post();
	            global $post;
				if($postcount == 0 ) {  ?>
					<li class="first clear">
<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'themejunkie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						
						<div class="entry-meta">
<?php the_time('M jS, Y') ?> &middot; <?php comments_popup_link( __( '0 Comment', 'themejunkie' ), __( '1 Comment', 'themejunkie' ), __( '% Comments', 'themejunkie' ) ); ?></div> <!-- .entry-meta -->

						<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('entry-thumb', array('class' => 'entry-thumb')); ?></a>
						<div class="entry-excerpt">
							<?php tj_content_limit(get_option('newswire_twocol_char_num','themejunkie')); ?>
						</div> <!-- .entry-excerpt -->
					</li> <!-- .first -->

				<li class="more"><?php _e('More', 'themejunkie'); ?> &raquo;</li>
				<?php } else {
	                echo '<li class="entry-title"><a href="'.get_permalink($post->ID).'" rel="bookmark">'.$post->post_title.'</a></li>';
	            }
	            $postcount++;	            	            
	        endwhile;
			wp_reset_query();
			echo '</ul></div><!-- .category-box -->';			
			if(!is_int($catcount/2)) echo '</div><div class="category-box-row clear">';
			$catcount++;
	    }
		echo '</div><!-- .category-box-row -->';
	?>
	
	<div class="clear"></div>
	
</div> <!-- .two-column-boxes -->
