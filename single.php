<?php get_header(); ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
        <div id="content">
        
            <?php get_template_part('includes/breadcrumbs'); ?>

		 	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
  
						<div class="entry-meta">
<?php the_time('M jS, Y') ?> &middot; <?php comments_popup_link( __( '0 Comment', 'themejunkie' ), __( '1 Comment', 'themejunkie' ), __( '% Comments', 'themejunkie' ) ); ?></div> <!--end .entry-meta-->
  
	<div class="entry-content">
		<?php if(get_option('newswire_integrate_singletop_enable') == 'on') echo (get_option('newswire_integration_single_top')); ?>
		<?php the_content(''); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'themejunkie' ), 'after' => '</div>' ) ); ?>

		<?php printf(the_tags(__('<div class="entry-tags"><span>Tags:</span>','themejunkie'),' &middot; ','</div>')); ?>
		  <?php edit_post_link('Edit', '<div class="entry-edit">( ', ' )</div>'); ?>
		<div class="clear"></div>

	</div><!--end .entry-->

			<?php if(get_option('newswire_integrate_singlebottom_enable') == 'on') echo (get_option('newswire_integration_single_bottom')); ?>	

<?php if( get_option('newswire_enable_share_buttons') == 'on' ) { ?>
	<div class="single-share">
            <h3>Share this post:</h3>
		<div class="btn-tweet">
		    <a href="http://twitter.com/share" class="twitter-share-button"
		    data-url="<?php the_permalink(); ?>"
		    data-via="<?php echo get_option('newswire_twitter_id'); ?>"
		    data-text="<?php the_title(); ?>"
		    data-related=""
		    data-count="horizontal"></a>
		</div><!-- .btn-tweet -->
		<script type="text/javascript">
			!function(d,s,id){
				var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
				if(!d.getElementById(id)){
					js=d.createElement(s);
					js.id=id;js.src=p+"://platform.twitter.com/widgets.js";
					fjs.parentNode.insertBefore(js,fjs);
				}
			}(document,"script","twitter-wjs");
		</script>
		<div class="btn-like">
		<iframe src="http://www.facebook.com/plugins/like.php?locale=en_US&amp;href=<?php the_permalink(); ?>&amp;layout=button_count&amp;show_faces=false&amp;width=100&amp;action=like&amp;font=arial&amp;colorscheme=light" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px;" allowTransparency="true"></iframe>
		</div><!-- .btn-like -->
		<div class="btn-plus">
			<g:plusone size="medium" href="<?php the_permalink();?>"></g:plusone>
		</div><!-- .btn-plus -->
	</div><!-- .single-share -->
		<div class="clear"></div>
<?php } ?>

<?php if(get_option('newswire_show_author_box') == 'on') { ?>	
			<div class="entry-author" class="clear">
				<div class="entry-author-content clear">
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'themejunkie_author_bio_avatar_size', 60 ) ); ?>
				</div> <!--end .author-avatar-->
				<div class="author-description">
					<h3><?php _e('About','themejunkie'); ?> <?php the_author(); ?></h3>
					<?php the_author_meta( 'description' ); ?>
					<div class="author-link">
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php printf( esc_attr__( 'View all posts by %s', 'themejunkie' ), get_the_author() ); ?>"><?php _e( 'View all posts by ', 'themejunkie' ); ?><?php the_author(); ?> &rarr;</a>
					</div> <!--end .author-link-->
				</div> <!--end .author-description-->
				</div>
			</div> <!--end .entry-author-->
			<?php } ?>

		<?php if(get_option('newswire_show_entry_bottom') == 'on') { ?>
			<div class="entry-related">
				<?php echo tj_related_posts(); ?>
				<div class="single-ad">
					<?php echo get_option('newswire_single_ad_code'); ?>
				</div>
				<div class="clear"></div>
			</div>
<div class="clear"></div>
			<?php } ?>
				
</div><!-- #post-<?php the_ID(); ?> -->
		
	<?php if(get_option('newswire_show_post_comments') == 'on') { ?>
		  		<?php comments_template('', true);  ?> 	
	  	<?php } ?>
	
	<?php endwhile; else: ?>	
	<?php endif; ?>
  
</div><!--end #content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>