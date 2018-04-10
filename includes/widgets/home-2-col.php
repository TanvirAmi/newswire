<?php
/**
 * Theme Junkie Video Widget
 */
class Home_Loop extends WP_Widget{

    public function __construct(){
        $widget_options = array(
            "classname"   => "home_loop_two_col",
            "description" => "Select two different category for different column",
        );
        parent::__construct("home_loop_two_col", "Two cols home loop", $widget_options);
    }

    public function widget($args, $instance){
		if(!isset($arg['widget_id'])){
            $arg['widget_id'] = $this->id;
        }
        
        // Set up default value
        $cat_1 = (!empty($instance['cat_1'])) ? $instance['cat_1'] : '';

        // Output the theme's $before_widget  wrapper
        echo $arg['before_widget'];
        if($cat_1):
            // Pull the category
            $cat_id = intval($cat_1);

            //Get the category
            $category = get_category($cat_id);

            // Get the category archive link
            $cat_link = get_category_link($cat_id);

            $query_arg = array(
                'posts_per_page' => 5,
                'post_type'      => 'post',
                'cat'            => $cat_1
            );

            $parent_cat_arg = array('hide_empty' => false, 'parent' => 0 );
            $parent_cat = get_terms('category',$parent_cat_arg);//category name
            echo '<div class="category-box-row clear">';
            echo '<div id="category-box2-1" class="category-box category-box-even">';

            
            echo '<span class="category-box-feed"><a href="'.get_category_feed_link($cat_id, '').'" title="';
            printf(__('Subscribe to %s','themejunkie'),$category->name);
            echo '">';
            printf(__('Subscribe to %s','themejunkie'),$category->name);
            echo '</a></span>';
            
            echo '<h3 class="category-box-title"><a href="'.$cat_link.'" title="View all posts under '.$category->name.'">'.$category->name.'</a></h3>';
            echo '<div class="sub-cat">';
            $child_arg = array( 'hide_empty' => false, 'parent' => $cat_id );
            $child_cat = get_terms( 'category', $child_arg );

                foreach( $child_cat as $child_term ) {
                    //echo '<li>'.get_term_link($child_term). '</li>'; //Child Category
                    //echo $child_term->name;
                   echo '<li class="child-cat"><a href="'.get_term_link($child_term).'">'. $child_term->name . '</a></li>';
                }
            echo '</div>';
            
            echo '<ul>';
            $query = new WP_Query($query_arg);
            $postcount = 0;
            while ($query->have_posts()) : $query->the_post();
                global $post;
                if($postcount == 0 ) {  ?>
                    <li class="first clear">
                        <h2 class="entry-title">
                            <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'themejunkie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                        </h2>
                        
                        <div class="entry-meta">
                        <?php the_time('M jS, Y') ?> &middot; <?php comments_popup_link( __( '0 Comment', 'themejunkie' ), __( '1 Comment', 'themejunkie' ), __( '% Comments', 'themejunkie' ) ); ?>
                        </div> <!-- .entry-meta -->

                        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('entry-thumb', array('class' => 'entry-thumb')); ?>
                        </a>

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
            wp_reset_postdata();
            echo '</ul></div><!-- .category-box -->';           
            //if(!is_int($catcount/2)) echo '</div><div class="category-box-row clear">';
            $catcount++;
        endif;


            // Second column
            // Set up default value
            $cat_2 = (!empty($instance['cat_2'])) ? $instance['cat_2'] : '';

            // Output the theme's $before_widget  wrapper
            if($cat_2):
            // Pull the category
            $cat_id = intval($cat_2);

            //Get the category
            $category = get_category($cat_id);

            // Get the category archive link
            $cat_link = get_category_link($cat_id);

            $query_arg = array(
                'posts_per_page' => 5,
                'post_type'      => 'post',
                'cat'            => $cat_2
            );

            $parent_cat_arg = array('hide_empty' => false, 'parent' => 0 );
            $parent_cat = get_terms('category',$parent_cat_arg);//category name
            //echo '<div class="category-box-row clear">';
            echo '<div id="category-box2-2" class="category-box category-box-odd">';

            
            echo '<span class="category-box-feed"><a href="'.get_category_feed_link($cat_id, '').'" title="';
            printf(__('Subscribe to %s','themejunkie'),$category->name);
            echo '">';
            printf(__('Subscribe to %s','themejunkie'),$category->name);
            echo '</a></span>';
            
            echo '<h3 class="category-box-title"><a href="'.$cat_link.'" title="View all posts under '.$category->name.'">'.$category->name.'</a></h3>';
            echo '<div class="sub-cat">';
            $child_arg = array( 'hide_empty' => false, 'parent' => $cat_id );
            $child_cat = get_terms( 'category', $child_arg );

                foreach( $child_cat as $child_term ) {
                    //echo '<li>'.get_term_link($child_term). '</li>'; //Child Category
                    //echo $child_term->name;
                   echo '<li class="child-cat"><a href="'.get_term_link($child_term).'">'. $child_term->name . '</a></li>';
                }
            echo '</div>';
            
            echo '<ul>';
            $query = new WP_Query($query_arg);
            $postcount = 0;
            while ($query->have_posts()) : $query->the_post();
                global $post;
                if($postcount == 0 ) {  ?>
                    <li class="first clear">
                        <h2 class="entry-title">
                            <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'themejunkie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                        </h2>
                        
                        <div class="entry-meta">
                        <?php the_time('M jS, Y') ?> &middot; <?php comments_popup_link( __( '0 Comment', 'themejunkie' ), __( '1 Comment', 'themejunkie' ), __( '% Comments', 'themejunkie' ) ); ?>
                        </div> <!-- .entry-meta -->

                        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('entry-thumb', array('class' => 'entry-thumb')); ?>
                        </a>

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
            wp_reset_postdata();
            echo '</ul></div><!-- .category-box -->';           
            echo '</div><div class="category-box-row clear">';

            $catcount++;
            // Close the widget wrapper
            echo '</div><!-- .category-box-row -->';
            echo '<div class="clear"></div>';

        endif;
            echo $arg['after_widget'];
    }

    /**
    * Display widget control options for the particular intance of the widget.
    *
    */
    public function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['cat_1'] = absint($new_instance['cat_1']);
        $instance['cat_2'] = absint($new_instance['cat_2']);
        return $instance;
    }


    /**
    * Display widget control options in the Widgets admin screen.
    *
    */
    public function form( $instance ) {
        $cat_1 = isset( $instance['cat_1'] ) ? intval( $instance['cat_1'] ) : '';
        $cat_2 = isset( $instance['cat_2'] ) ? intval( $instance['cat_2'] ) : '';
    ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'cat_1' ); ?>"><?php esc_html_e( 'Choose Category1:', 'newswire' ); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id( 'cat_1' ); ?>" name="<?php echo $this->get_field_name( 'cat_1' ); ?>" style="width:100%;">
                <?php $categories = get_terms( 'category' ); ?>
                <?php foreach( $categories as $category ) { ?>
                    <option value="<?php echo absint( $category->term_id ); ?>" <?php selected( $cat_1, absint( $category->term_id ) ); ?>><?php echo esc_html( $category->name ); ?></option>
                <?php } ?>
            </select>
        </p>
          <p>
            <label for="<?php echo $this->get_field_id( 'cat_2' ); ?>"><?php esc_html_e( 'Choose Category2:', 'newswire' ); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id( 'cat_2' ); ?>" name="<?php echo $this->get_field_name( 'cat_2' ); ?>" style="width:100%;">
                <?php $categories = get_terms( 'category' ); ?>
                <?php foreach( $categories as $category ) { ?>
                    <option value="<?php echo absint( $category->term_id ); ?>" <?php selected( $cat_2, absint( $category->term_id ) ); ?>><?php echo esc_html( $category->name ); ?></option>
                <?php } ?>
            </select>
        </p>

    <?php
    }

}
register_widget('Home_Loop');