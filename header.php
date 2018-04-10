<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title><?php tj_custom_titles(); ?></title>
<?php tj_custom_description(); ?>
<?php tj_custom_keywords(); ?>
<?php tj_custom_canonical(); ?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/colors/<?php echo get_option('newswire_theme_stylesheet');?>" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/media-queries.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/custom.css" />
<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper">
	<div id="primary-nav">
	    <?php $menuClass = 'nav';
		$menuID = 'primary-navigation';
		$primaryNav = '';
		if (function_exists('wp_nav_menu')) {
			$primaryNav = wp_nav_menu( array( 'theme_location' => 'primary-nav', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'menu_id' => $menuID, 'echo' => false ) );
		};
		if ($primaryNav == '') { ?>
			<ul id="<?php echo $menuID; ?>" class="<?php echo $menuClass; ?>">
		<?php if (get_option('newswire_home_link') == 'on') { ?>
				<li class="<?php if(!is_page()) echo('first');?>"><a href="<?php echo home_url(); ?>"><?php _e('Home', 'themejunkie') ?></a></li>
		<?php } ?>						
				<?php show_page_menu($menuClass,false,false); ?>
			</ul>
		<?php }	else echo($primaryNav); ?>
		<?php get_search_form(); ?>
	</div><!-- #primary-nav -->
			
	<div id="header">
		<?php if (get_option('newswire_text_logo_enable') == 'on') { ?>
			<div id="text-logo">
				<h1 id="site-title"><a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo('name'); ?></a></h1>
				<p id="site-desc"><?php bloginfo('description'); ?></p>
			</div><!-- #text-logo -->
		<?php } else { ?>
			<a href="<?php echo esc_url( home_url() ); ?>"><?php $logo = (get_option('newswire_logo') <> '') ? get_option('newswire_logo') : get_template_directory_uri().'/images/logo.png'; ?><img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>" id="logo"/></a>
		<?php }?>
	    <?php /* Header Ad */
		if( get_option('newswire_header_ad_enable') == 'on'){
			echo "<div class='header-ad'>";
			echo get_option('newswire_header_ad_code');
			echo "</div>";
		} ?>
		<a class="button-menu" id="toggle" href="#"></a>			
		<div class="clear"></div> 
	</div><!-- #header-->

	<div id="secondary-nav">
		<?php $menuClass = 'nav';
		$menuID = 'secondary-navigation';
		$secondaryNav = '';
		if (function_exists('wp_nav_menu')) {
			$secondaryNav = wp_nav_menu( array( 'theme_location' => 'secondary-nav', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'menu_id' => $menuID, 'echo' => false ) );
		};
		if ($secondaryNav == '') { ?>
			<ul id="<?php echo $menuID; ?>" class="<?php echo $menuClass; ?>">
				<?php show_categories_menu($menuClass,false,false); ?>
			</ul>
		<?php }	else echo($secondaryNav); ?>
	</div><!-- #secondary-nav -->

	<div id="main">