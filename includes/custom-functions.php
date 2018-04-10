<?php

add_theme_support( 'automatic-feed-links' );
add_editor_style();
//add_custom_image_header();

/*
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
add_theme_support( "title-tag" );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 615;

/*-----------------------------------------------------------------------------------*/
/*	Custom Menus
/*-----------------------------------------------------------------------------------*/
function register_main_menus() {
	register_nav_menus(
		array(
			'primary-nav' => __( 'Primary Nav','themejunkie' ),
			'secondary-nav' => __( 'Secondary Nav','themejunkie' ),
		)
	);
}

if (function_exists('register_nav_menus')) add_action( 'init', 'register_main_menus' );

/*-----------------------------------------------------------------------------------*/
/*	Register and deregister Scripts files	
/*-----------------------------------------------------------------------------------*/
if(!is_admin()) {
	add_action( 'wp_print_scripts', 'my_deregister_scripts', 100 );
}

function my_deregister_scripts() {
		wp_deregister_script( 'jquery' );
		wp_enqueue_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js', false, '1.8.3');
		wp_enqueue_script('jquery-ui', get_template_directory_uri().'/includes/js/jquery-ui-1.8.5.custom.min.js', false, '1.8.5');
		wp_enqueue_script('jquery-superfish', get_template_directory_uri().'/includes/js/superfish.js', false, '1.4.2');
		wp_enqueue_script('jquery-custom', get_template_directory_uri().'/includes/js/custom.js', false, '1.4.2');
		//wp_enqueue_script('html5', get_template_directory_uri() .'/includes/js/html5.js', false, '1.0');
		wp_enqueue_script('srolltop', get_template_directory_uri().'/includes/js/scrolltop.js', false, '1.0');
		
		
		if(is_single()) { 
			// wp_enqueue_script('twitter-button', 'http://platform.twitter.com/widgets.js', false, '1.0');
			wp_enqueue_script('gpone-button', 'https://apis.google.com/js/plusone.js', false, '1.0');
		}

		if ( is_singular() && get_option('thread_comments') ) wp_enqueue_script( 'comment-reply' );
}
/*-----------------------------------------------------------------------------------*/
/*	Remove Image Caption from Index/Archive/Search Page
/*-----------------------------------------------------------------------------------*/
if (is_home() || is_archive() || is_search() ) {
	add_filter('img_caption_shortcode', create_function('$a, $b, $c','return $c;'), 10, 3);
} 

/*-----------------------------------------------------------------------------------*/
/*	Exclude Pages from Search Results
/*-----------------------------------------------------------------------------------*/
function tj_exclude_pages($query) {
        if ($query->is_search) {
        $query->set('post_type', 'post');
                                }
        return $query;
}
add_filter('pre_get_posts','tj_exclude_pages');

/*-----------------------------------------------------------------------------------*/
/*	Get Limit Excerpt
/*-----------------------------------------------------------------------------------*/
function tj_content_limit($max_char, $more_link_text = '', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = strip_tags($content);

   if ( isset( $_GET['p'] ) && (strlen($_GET['p']) > 0) ) {
      echo "";
      echo $content;
      echo "...";
   }
   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        $content = substr($content, 0, $espacio);
        $content = $content;
        echo "";
        echo $content;
        echo "...";
   }
   else {
      echo "";
      echo $content;
   }
}

/*-----------------------------------------------------------------------------------*/
/*	Comment Styling
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'tj_comment' ) ) {
	function tj_comment($comment, $args, $depth) {
	
	    $isByAuthor = false;
	
	    if($comment->comment_author_email == get_the_author_meta('email')) {
	        $isByAuthor = true;
	    }
	
        $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class(($isByAuthor ? 'author-comment' : '')); ?> id="li-comment-<?php comment_ID() ?>">

            <div id="comment-<?php comment_ID(); ?>">
                <div class="line"></div>
                
                <?php echo get_avatar($comment,$size='36'); ?>
                
                <div class="comment-author vcard">
                    <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>', 'themejunkie'), get_comment_author_link()) ?>
                </div>

                <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s', 'themejunkie'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)', 'themejunkie'),'  ','') ?> / <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>

                <?php if ($comment->comment_approved == '0') : ?>
                    <em class="moderation"><?php _e('Your comment is awaiting moderation.', 'themejunkie') ?></em>
                    <br />
                <?php endif; ?>

                <div class="comment-body">
                    <?php comment_text() ?>
                </div>

            </div>
	<?php
	}
}


/*-----------------------------------------------------------------------------------*/
/*	Seperated Pings Styling
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'tj_list_pings' ) ) {
	function tj_list_pings($comment, $args, $depth) {
	    $GLOBALS['comment'] = $comment; ?>
		<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
		<?php 
	}
}

/*-----------------------------------------------------------------------------------*/
/*	Twitter Widget
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'tj_twitter_script') ) {
	function tj_twitter_script($unique_id,$username,$limit) {
	?>
	<script type="text/javascript">
	<!--//--><![CDATA[//><!--
	
	    function twitterCallback2(twitters) {
	    
	      var statusHTML = [];
	      for (var i=0; i<twitters.length; i++){
	        var username = twitters[i].user.screen_name;
	        var status = twitters[i].text.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
	          return '<a href="'+url+'">'+url+'</a>';
	        }).replace(/\B@([_a-z0-9]+)/ig, function(reply) {
	          return  reply.charAt(0)+'<a href="http://twitter.com/'+reply.substring(1)+'">'+reply.substring(1)+'</a>';
	        });
	        statusHTML.push( '<li><span class="content">'+status+'</span> <a style="font-size:85%" class="time" href="http://twitter.com/'+username+'/statuses/'+twitters[i].id_str+'">'+relative_time(twitters[i].created_at)+'</a></li>' );
	      }
	      document.getElementById( 'twitter_update_list_<?php echo $unique_id; ?>').innerHTML = statusHTML.join( '' );
	    }
	    
	    function relative_time(time_value) {
	      var values = time_value.split( " " );
	      time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
	      var parsed_date = Date.parse(time_value);
	      var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
	      var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
	      delta = delta + (relative_to.getTimezoneOffset() * 60);
	    
	      if (delta < 60) {
	        return 'less than a minute ago';
	      } else if(delta < 120) {
	        return 'about a minute ago';
	      } else if(delta < (60*60)) {
	        return (parseInt(delta / 60)).toString() + ' minutes ago';
	      } else if(delta < (120*60)) {
	        return 'about an hour ago';
	      } else if(delta < (24*60*60)) {
	        return 'about ' + (parseInt(delta / 3600)).toString() + ' hours ago';
	      } else if(delta < (48*60*60)) {
	        return '1 day ago';
	      } else {
	        return (parseInt(delta / 86400)).toString() + ' days ago';
	      }
	    }
	//-->!]]>
	</script>
	<script type="text/javascript" src="http://api.twitter.com/1/statuses/user_timeline/<?php echo $username; ?>.json?callback=twitterCallback2&amp;count=<?php echo $limit; ?>&amp;include_rts=t"></script>
	<?php
	}
}

function tj_save_tweet_link($id) {
	$url = sprintf('%s?p=%s', home_url().'/', $id);

	add_post_meta($id, 'tweet_trim_url_2', $url);
	
	return $url;
}

function tj_the_tweet_link() {
	if (!$url = get_post_meta(get_the_ID(), 'tweet_trim_url_2', true)) {
	  $url = tj_save_tweet_link(get_the_ID());
	}
	
	if ($old_url = get_post_meta(get_the_ID(), 'tweet_trim_url', true)) {
	  delete_post_meta(get_the_ID(), 'tweet_trim_url');
	}
	
	$output_url = sprintf(
	  'http://twitter.com/home?status=%s%s%s',
	  urlencode(get_the_title()),
	  urlencode(' - '),
	  $url
	);
	$output_url = str_replace('+','%20',$output_url);
	return $output_url;
}


/*-----------------------------------------------------------------------------------*/
/*	Related Posts
/*-----------------------------------------------------------------------------------*/
function tj_related_posts() {
	global $post, $wpdb;
	$backup = $post;  // backup the current object
	$tags = wp_get_post_tags($post->ID);
	$tagIDs = array();
	if ($tags) {
	  $tagcount = count($tags);
	  for ($i = 0; $i < $tagcount; $i++) {
	    $tagIDs[$i] = $tags[$i]->term_id;
	  }
	  
	  $args=array(
	    'tag__in' => $tagIDs,
	    'post__not_in' => array($post->ID),
	    'showposts'=>3,
	    'ignore_sticky_posts'=>1
	  );
	  $my_query = new WP_Query($args);
	  $related_post_found = false;
	  if( $my_query->have_posts() ) { $related_post_found = true; ?>
		<h3 class="section-title"><?php _e('Related Posts','themejunkie'); ?></h3>
			<ul class="related-loop">		
	    <?php $post_count = 1; while ($my_query->have_posts()) : $my_query->the_post(); ?>
				 <li <?php if($post_count == 3) { echo('class="last-entry"'); }?>>
			 <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('sidebar-thumb', array('class' => 'entry-thumb')); ?></a>
			  
		<h2 class="entry-title"><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
	<div class="entry-meta">
		<?php the_time('m/j/Y') ?> &middot; <?php comments_popup_link( __( '0 Comment', 'themejunkie' ), __( '1 Comment', 'themejunkie' ), __( '% Comments', 'themejunkie' ) ); ?>
	</div><!--end .entry-meta-->
                          </li>			
	    <?php $post_count++; endwhile; wp_reset_query(); ?>
			</ul>		
	  <?php }
	}
	
	//show recent posts if no related found
	if(!$related_post_found){ ?>
		<h3 class="section-title"><?php _e('Bài mới','themejunkie'); ?></h3>
		<ul class="related-loop">
		<?php
		$post_count = 1;
		$posts = get_posts('numberposts=3&offset=0');
		foreach($posts as $post) { ?>
			<li <?php if($post_count == 3) { echo('class="last-entry"'); }?>>
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('sidebar-thumb', array('class' => 'entry-thumb')); ?></a>
				<h2 class="entry-title"><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
				<div class="entry-meta">
					<?php the_time('m/j/Y') ?> &middot; <?php comments_popup_link( __( '0 Comment', 'themejunkie' ), __( '1 Comment', 'themejunkie' ), __( '% Comments', 'themejunkie' ) ); ?>
				</div><!-- .entry-meta -->
			</li>			
		<?php $post_count++; } wp_reset_query(); ?>
		</ul>
		<?php 
	}
	wp_reset_query();
}

/*-----------------------------------------------------------------------------------*/
/*	Turn a category ID to a Name
/*-----------------------------------------------------------------------------------*/
function cat_id_to_name($id) {
	foreach((array)(get_categories()) as $category) {
    	if ($id == $category->cat_ID) { return $category->cat_name; break; }
	}
}

?>