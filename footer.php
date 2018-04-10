	</div><!-- #main -->

	<div class="clear"></div>
	
	<div class="footer-categories">
		<ul>
			<li><a href="<?php echo esc_url( home_url() ); ?>"><?php _e('Home','themejunkie'); ?></a></li>
			<?php wp_list_categories('title_li=&orderby=id&depth=1');?>
		</ul>
		<div class="clear"></div>
	</div><!-- .footer-categories -->

	<div class="copyright">
		<p>&copy; <?php echo mysql2date('Y',current_time('timestamp')); ?> <a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo('name'); ?></a>. All rights reserved.</p>
		<p> Website tài liệu học tập trực tuyến hàng đầu Việt Nam. Liên hệ: info@hoc360.net </p>
	</div><!-- .copyright -->

	<div class="clear"></div>

</div><!-- #wrapper -->

<a id="back-to-top" href="#"></a>

<?php wp_footer(); ?>

</body>
</html>