<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<title><?php
	global $page, $paged;

	wp_title( '|', true, 'right' );

	bloginfo( 'name' );

	$site_description = get_bloginfo('description', 'display');
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . __('Page', 'newsroom') . max($paged, $page);

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico" type="image/x-icon" />
<meta name="viewport" content="width=device-width,initial-scale=1" />

<?php wp_head(); ?>
</head>
<body <?php body_class(get_bloginfo('language')); ?>>
	<header id="masthead">
		<div>
			<div class="site-meta">
				<?php newsroom_logo(); ?>
			</div>
			<nav id="langnav">
				<?php
				if(function_exists('qtranxf_generateLanguageSelectCode')) {
					echo qtranxf_generateLanguageSelectCode('text');
				}
				?>
			</nav>
		</div>
		<div>
			<nav id="mastnav">
				<?php wp_nav_menu(array('theme_location' => 'header_menu')); ?>
	      <?php get_search_form(); ?>
			</nav>
		</div>
	</header>
	<div class="mobile-header" style="display:none;">
		<?php newsroom_logo(true); ?>
	</div>
