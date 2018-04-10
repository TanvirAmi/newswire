<?php
/*
Plugin Name: Category Posts Widget
Plugin URI: http://jameslao.com/2011/03/24/category-posts-widget-3-2/
Description: Adds a widget that can display posts from a single category.
Author: James Lao	
Version: 3.3
Author URI: http://jameslao.com/
*/

class tj_category_posts extends WP_Widget {

function tj_category_posts() {
	parent::__construct(false, $name='ThemeJunkie - Category Posts', $widget_options = array('description'=>'Display posts from a single category'));	
}

/**
 * Displays category posts widget on blog.
 */
function widget($args, $instance) {
	global $post;
	$post_old = $post; // Save the post object.
	
	extract( $args );
		
	// If not title, use the name of the category.
	if( !$instance["title"] ) {
		$category_info = get_category($instance["cat"]);
		$instance["title"] = $category_info->name;
  }

  $valid_sort_orders = array('date', 'title', 'comment_count', 'rand');
  if ( in_array($instance['sort_by'], $valid_sort_orders) ) {
    $sort_by = $instance['sort_by'];
    $sort_order = (bool) $instance['asc_sort_order'] ? 'ASC' : 'DESC';
  } else {
    // by default, display latest first
    $sort_by = 'date';
    $sort_order = 'DESC';
  }
	
	// Get array of post info.
  $cat_posts = new WP_Query(
    "showposts=" . $instance["num"] . 
    "&cat=" . $instance["cat"] .
    "&orderby=" . $sort_by .
    "&order=" . $sort_order
  );

	// Excerpt length filter
	$new_excerpt_length = create_function('$length', "return " . $instance["excerpt_length"] . ";");
	if ( $instance["excerpt_length"] > 0 )
		add_filter('excerpt_length', $new_excerpt_length);
	
	echo $before_widget;
	
	// Widget title
	echo $before_title;
	if( $instance["title_link"] )
		echo '<a href="' . get_category_link($instance["cat"]) . '">' . $instance["title"] . '</a>';
	else
		echo $instance["title"];
	echo $after_title;

	// Post list
	echo "<ul>\n";
	
	while ( $cat_posts->have_posts() )
	{
		$cat_posts->the_post();
	?>
		<li class="cat-post-item">
			<?php
				if (
					function_exists('the_post_thumbnail') &&
					current_theme_supports("post-thumbnails") &&
					$instance["thumb"] &&
					has_post_thumbnail()
				) :
			?>
			
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_post_thumbnail('small-thumb', array('class' => 'entry-thumb')); ?></a>
						
			<?php endif; ?>

			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

			<?php if ( $instance['meta'] ) : ?>
			<p class="entry-meta"><span class="entry-date"><?php the_time('M jS, Y') ?></span><span class="entry-comment"> &middot; <?php comments_popup_link( __( '0 Comment', 'themejunkie' ), __( '1 Comment', 'themejunkie' ), __( '% Comments', 'themejunkie' ) ); ?></span></p>
			<?php endif; ?>
			
			<?php if ( $instance['excerpt'] ) : ?>
			<p class="entry-excerpt"><?php tj_content_limit('80'); ?> </p>
			<?php endif; ?>
			<div class="clear"></div>
		</li>
	<?php
	}
	
	echo "</ul>\n";
	
	echo $after_widget;

	remove_filter('excerpt_length', $new_excerpt_length);
	
	$post = $post_old; // Restore the post object.
}

/**
 * The configuration form.
 */
function form($instance) {
?>

		<?php
			$instance = wp_parse_args( (array) $instance, array( 'num' => '3', 'title_link' => 'true','excerpt' => 'true', 'meta' => 'true', 'thumb' => 'true' )); 
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id("title"); ?>">
				<?php _e( 'Title', 'themejunkie' ); ?>:
				<input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
			</label>
		</p>
		
		<p>
			<label>
				<?php _e( 'Category', 'themejunkie' ); ?>:
				<?php wp_dropdown_categories( array( 'name' => $this->get_field_name("cat"), 'selected' => $instance["cat"] ) ); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id("num"); ?>">
				<?php _e('Number of posts to show', 'themejunkie'); ?>:
				<input style="text-align: center;" id="<?php echo $this->get_field_id("num"); ?>" name="<?php echo $this->get_field_name("num"); ?>" type="text" value="<?php echo absint($instance["num"]); ?>" size='3' />
			</label>
    </p>

    <p>
			<label for="<?php echo $this->get_field_id("sort_by"); ?>">
        <?php _e('Sort by', 'themejunkie'); ?>:
        <select id="<?php echo $this->get_field_id("sort_by"); ?>" name="<?php echo $this->get_field_name("sort_by"); ?>">
          <option value="date"<?php selected( $instance["sort_by"], "date" ); ?>>Date</option>
          <option value="title"<?php selected( $instance["sort_by"], "title" ); ?>>Title</option>
          <option value="comment_count"<?php selected( $instance["sort_by"], "comment_count" ); ?>>Number of comments</option>
          <option value="rand"<?php selected( $instance["sort_by"], "rand" ); ?>>Random</option>
        </select>
			</label>
    </p>
		
		<p>
			<label for="<?php echo $this->get_field_id("asc_sort_order"); ?>">
        <input type="checkbox" class="checkbox" 
          id="<?php echo $this->get_field_id("asc_sort_order"); ?>" 
          name="<?php echo $this->get_field_name("asc_sort_order"); ?>"
          <?php checked( (bool) $instance["asc_sort_order"], true ); ?> />
				<?php _e( 'Reverse sort order (ascending)', 'themejunkie' ); ?>
			</label>
    </p>

		<p>
			<label for="<?php echo $this->get_field_id("title_link"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("title_link"); ?>" name="<?php echo $this->get_field_name("title_link"); ?>"<?php checked( (bool) $instance["title_link"], true ); ?> />
				<?php _e( 'Make widget title link', 'themejunkie' ); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id("excerpt"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("excerpt"); ?>" name="<?php echo $this->get_field_name("excerpt"); ?>"<?php checked( (bool) $instance["excerpt"], true ); ?> />
				<?php _e( 'Show post excerpt', 'themejunkie' ); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id("meta"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("meta"); ?>" name="<?php echo $this->get_field_name("meta"); ?>"<?php checked( (bool) $instance["meta"], true ); ?> />
				<?php _e( 'Show post meta (date & comment)', 'themejunkie' ); ?>
			</label>
		</p>
		
		<?php if ( function_exists('the_post_thumbnail') && current_theme_supports("post-thumbnails") ) : ?>
		<p>
			<label for="<?php echo $this->get_field_id("thumb"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("thumb"); ?>" name="<?php echo $this->get_field_name("thumb"); ?>"<?php checked( (bool) $instance["thumb"], true ); ?> />
				<?php _e( 'Show post thumbnail', 'themejunkie' ); ?>
			</label>
		</p>
		<?php endif; ?>

<?php

}

}

add_action( 'widgets_init', create_function('', 'return register_widget("tj_category_posts");') );

?>
